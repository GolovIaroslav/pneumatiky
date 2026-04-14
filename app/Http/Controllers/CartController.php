<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    private const SHIPPING_OPTIONS = [
        'packeta' => ['label' => 'Packeta', 'price' => 1.29],
        'address' => ['label' => 'Doručenie na adresu', 'price' => 3.29],
        'store' => ['label' => 'Na predajni', 'price' => 0.00],
        'warehouse' => ['label' => 'Zo skladu', 'price' => 0.99],
    ];

    private const PAYMENT_OPTIONS = [
        'card_online' => ['label' => 'Kartou online', 'price' => 0.00],
        'revolut' => ['label' => 'Revolut', 'price' => 0.99],
        'paysafecard' => ['label' => 'PaySafeCard', 'price' => 1.49],
        'card_on_delivery' => ['label' => 'Kartou pri prebratí', 'price' => 2.99],
        'cash_on_delivery' => ['label' => 'Hotovosťou pri prebratí', 'price' => 5.00],
    ];

    public function index()
    {
        $cartData = session('cart', []);
        $cartItems = [];
        $total = 0;

        if (!empty($cartData)) {
            $ids = array_keys($cartData);
            $products = Product::with(['images' => fn ($q) => $q->orderByDesc('is_main')])
                ->whereIn('id', $ids)
                ->get()
                ->keyBy('id');

            foreach ($cartData as $productId => $item) {
                if (!isset($products[$productId])) {
                    continue;
                }
                $product = $products[$productId];
                $qty = max(1, (int) $item['qty']);
                $subtotal = $product->price * $qty;
                $total += $subtotal;
                $cartItems[] = [
                    'product'  => $product,
                    'qty'      => $qty,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('cart', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'qty'        => 'required|integer|min:1',
        ]);

        $productId = (int) $request->input('product_id');
        $qty       = max(1, (int) $request->input('qty'));

        $product = Product::findOrFail($productId);
        $cart = session('cart', []);
        
        $currentInCart = isset($cart[$productId]) ? $cart[$productId]['qty'] : 0;
        
        if (($currentInCart + $qty) > $product->stock) {
            return redirect()->back()->with('error', "Nie je možné pridať viac kusov. Na sklade je celkovo len {$product->stock} ks.");
        }

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += $qty;
        } else {
            $cart[$productId] = ['product_id' => $productId, 'qty' => $qty];
        }

        session(['cart' => $cart]);

        return redirect()->route('cart')->with('success', 'Produkt bol pridaný do košíka.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'qty'        => 'required|integer|min:1',
        ]);

        $productId = (int) $request->input('product_id');
        $qty       = max(1, (int) $request->input('qty'));

        $product = Product::findOrFail($productId);
        if ($qty > $product->stock) {
            return redirect()->back()->with('error', "Nie je možné nastaviť viac kusov. Na sklade je len {$product->stock} ks.");
        }

        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] = $qty;
            session(['cart' => $cart]);
        }

        return redirect()->route('cart');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $productId = (int) $request->input('product_id');

        $cart = session('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);

        return redirect()->route('cart');
    }

    public function transport()
    {
        [$cartItems, $total] = $this->buildCartItemsAndTotal();

        if (empty($cartItems)) {
            return redirect()->route('cart')->with('error', 'Košík je prázdny, najprv pridajte produkty.');
        }

        $shippingOptions = self::SHIPPING_OPTIONS;
        $paymentOptions = self::PAYMENT_OPTIONS;

        $selectedShipping = (string) session('checkout.shipping', array_key_first($shippingOptions));
        if (! array_key_exists($selectedShipping, $shippingOptions)) {
            $selectedShipping = array_key_first($shippingOptions);
        }

        $selectedPayment = (string) session('checkout.payment', array_key_first($paymentOptions));
        if (! array_key_exists($selectedPayment, $paymentOptions)) {
            $selectedPayment = array_key_first($paymentOptions);
        }

        $shippingPrice = (float) $shippingOptions[$selectedShipping]['price'];
        $paymentPrice = (float) $paymentOptions[$selectedPayment]['price'];
        $extraTotal = $shippingPrice + $paymentPrice;
        $grandTotal = $total + $extraTotal;

        return view('transport', compact(
            'total',
            'shippingOptions',
            'paymentOptions',
            'selectedShipping',
            'selectedPayment',
            'shippingPrice',
            'paymentPrice',
            'extraTotal',
            'grandTotal'
        ));
    }

    public function saveTransport(Request $request)
    {
        $data = $request->validate([
            'shipping' => ['required', 'string', Rule::in(array_keys(self::SHIPPING_OPTIONS))],
            'payment' => ['required', 'string', Rule::in(array_keys(self::PAYMENT_OPTIONS))],
        ]);

        session([
            'checkout.shipping' => $data['shipping'],
            'checkout.payment' => $data['payment'],
        ]);

        return redirect()->route('delivery');
    }

    public function delivery()
    {
        if (! session()->has('checkout.shipping') || ! session()->has('checkout.payment')) {
            return redirect()->route('transport')->with('error', 'Najprv vyberte spôsob dopravy a platby.');
        }

        return view('delivery');
    }

    public function saveDelivery(Request $request)
    {
        $data = $request->validate([
            'meno' => 'required',
            'priezvisko' => 'required',
            'email' => 'required|email',
            'telefon' => 'required',
            'ulica' => 'required',
            'mesto' => 'required',
            'psc' => 'required',
            'poznamka' => 'nullable',
        ]);

        session(['delivery_info' => $data]);
        return redirect()->route('summary');
    }

    public function summary()
    {
        [$cartItems, $total] = $this->buildCartItemsAndTotal();

        $deliveryInfo = session('delivery_info', []);

        $selectedShipping = (string) session('checkout.shipping', array_key_first(self::SHIPPING_OPTIONS));
        if (! array_key_exists($selectedShipping, self::SHIPPING_OPTIONS)) {
            $selectedShipping = array_key_first(self::SHIPPING_OPTIONS);
        }

        $selectedPayment = (string) session('checkout.payment', array_key_first(self::PAYMENT_OPTIONS));
        if (! array_key_exists($selectedPayment, self::PAYMENT_OPTIONS)) {
            $selectedPayment = array_key_first(self::PAYMENT_OPTIONS);
        }

        $shippingLabel = self::SHIPPING_OPTIONS[$selectedShipping]['label'];
        $shippingPrice = (float) self::SHIPPING_OPTIONS[$selectedShipping]['price'];
        $paymentLabel = self::PAYMENT_OPTIONS[$selectedPayment]['label'];
        $paymentPrice = (float) self::PAYMENT_OPTIONS[$selectedPayment]['price'];

        $extraTotal = $shippingPrice + $paymentPrice;
        $totalSUpravou = $total + $extraTotal;

        return view('summary', compact(
            'cartItems',
            'total',
            'deliveryInfo',
            'shippingLabel',
            'shippingPrice',
            'paymentLabel',
            'paymentPrice',
            'extraTotal',
            'totalSUpravou'
        ));
    }

    private function buildCartItemsAndTotal(): array
    {
        $cartData = session('cart', []);
        $cartItems = [];
        $total = 0;

        if (! empty($cartData)) {
            $ids = array_keys($cartData);
            $products = Product::with(['images' => fn ($q) => $q->orderByDesc('is_main')])
                ->whereIn('id', $ids)
                ->get()
                ->keyBy('id');

            foreach ($cartData as $productId => $item) {
                if (! isset($products[$productId])) {
                    continue;
                }

                $product = $products[$productId];
                $qty = max(1, (int) $item['qty']);
                $subtotal = $product->price * $qty;
                $total += $subtotal;
                $cartItems[] = [
                    'product' => $product,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return [$cartItems, $total];
    }
}
