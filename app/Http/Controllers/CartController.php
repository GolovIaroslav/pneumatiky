<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        if (Auth::check()) {
            $cart = Auth::user()->cart;
            if ($cart && $cart->isExpired()) {
                $cart->items()->delete();
                $cart->delete();
                $cart = null;
            }
            $cartData = $cart ? $cart->items()->pluck('qty', 'product_id')->toArray() : [];
        } else {
            $cartData = session('cart', []);
        }

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
                $rawQty = is_array($item) ? ($item['qty'] ?? 1) : $item;
                $qty = max(1, (int) $rawQty);
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

        if (Auth::check()) {
            $cart = Auth::user()->cart;
            if (!$cart) {
                $cart = Cart::create(['user_id' => Auth::id(), 'expires_at' => now()->addDays(30)]);
            } elseif ($cart->isExpired()) {
                $cart->items()->delete();
                $cart->update(['expires_at' => now()->addDays(30)]);
            } else {
                $cart->refreshExpiration();
            }

            $cartItem = $cart->items()->firstOrCreate(
                ['product_id' => $productId],
                ['qty' => 0]
            );
            
            $currentQty = $cartItem->qty;
            if (($currentQty + $qty) > $product->stock) {
                return redirect()->back()->with('error', "Nie je možné pridať viac kusov. Na sklade je celkovo len {$product->stock} ks.");
            }
            
            $cartItem->increment('qty', $qty);
        } else {
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
        }

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

        if (Auth::check()) {
            $cart = Auth::user()->cart;
            if ($cart && $cartItem = $cart->items()->where('product_id', $productId)->first()) {
                $cartItem->update(['qty' => $qty]);
                $cart->refreshExpiration();
            }
        } else {
            $cart = session('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['qty'] = $qty;
                session(['cart' => $cart]);
            }
        }

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $productId = (int) $request->input('product_id');

        if (Auth::check()) {
            $cart = Auth::user()->cart;
            if ($cart) {
                $cart->items()->where('product_id', $productId)->delete();
                if ($cart->items()->count() === 0) {
                    $cart->delete();
                }
            }
        } else {
            $cart = session('cart', []);
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

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
            'meno' => ['required', 'string', 'max:100'],
            'priezvisko' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'telefon' => ['required', 'string', 'regex:/^\+421\d{8,}$/'],
            'ulica' => ['required', 'string', 'max:100'],
            'mesto' => ['required', 'string', 'max:100'],
            'psc' => ['required', 'regex:/^\d{5}$/'],
            'poznamka' => ['nullable', 'string', 'max:1000'],
        ], [
            'meno.max' => 'Meno môže mať najviac 100 znakov.',
            'priezvisko.max' => 'Priezvisko môže mať najviac 100 znakov.',
            'email.email' => 'Zadajte platný e-mail.',
            'email.max' => 'E-mail môže mať najviac 100 znakov.',
            'telefon.regex' => 'Telefónne číslo musí byť valídne v tvare +421...',
            'ulica.max' => 'Ulica a číslo môžu mať najviac 100 znakov.',
            'mesto.max' => 'Mesto môže mať najviac 100 znakov.',
            'psc.regex' => 'PSČ musí mať presne 5 číslic.',
            'poznamka.max' => 'Poznámka môže mať najviac 1000 znakov.',
        ]);

        session(['delivery_info' => $data]);
        return redirect()->route('summary');
    }

    public function summary()
    {
        [$cartItems, $total] = $this->buildCartItemsAndTotal();

        if (empty($cartItems)) {
            return redirect()->route('cart')->with('error', 'Košík je prázdny.');
        }

        if (! session()->has('delivery_info')) {
            return redirect()->route('delivery')->with('error', 'Najprv vyplňte dodacie údaje.');
        }

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

    public function confirmOrder()
    {
        [$cartItems, $total] = $this->buildCartItemsAndTotal();
        $deliveryInfo = session('delivery_info');
        
        if (empty($cartItems) || empty($deliveryInfo)) {
            return redirect()->route('cart')->with('error', 'Chyba objednávky. Košík je prázdny.');
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
        $grandTotal = $total + $shippingPrice + $paymentPrice;

        $order = null;
        try {
            DB::transaction(function () use ($cartItems, $grandTotal, $selectedShipping, $selectedPayment, $deliveryInfo, &$order) {
                $order = new \App\Models\Order();
                $order->user_id = Auth::id();
                $order->total_price = $grandTotal;
                $order->status = 'pending';
                $order->shipping_method = $selectedShipping;
                $order->payment_method = $selectedPayment;
                $order->delivery_name = $deliveryInfo['meno'] . ' ' . $deliveryInfo['priezvisko'];
                $order->delivery_email = $deliveryInfo['email'];
                $order->delivery_phone = $deliveryInfo['telefon'];
                $order->delivery_address = $deliveryInfo['ulica'] . ', ' . $deliveryInfo['mesto'] . ', ' . $deliveryInfo['psc'];
                $order->save();

                foreach ($cartItems as $item) {
                    $product = Product::lockForUpdate()->find($item['product']->id);
                    if (!$product || $product->stock < $item['qty']) {
                        throw new \Exception("Produkt '{$item['product']->name}' nie je dostupný v požadovanom množstve.");
                    }

                    $orderItem = new \App\Models\OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $product->id;
                    $orderItem->quantity = $item['qty'];
                    $orderItem->unit_price = $product->price;
                    $orderItem->save();

                    $product->decrement('stock', $item['qty']);
                }

                if (Auth::check()) {
                    $userCart = Auth::user()->cart;
                    if ($userCart) {
                        $userCart->items()->delete();
                        $userCart->delete();
                    }
                }
            });
        } catch (\Exception $e) {
            return redirect()->route('cart')->with('error', $e->getMessage());
        }

        session()->forget([
            'cart',
            'checkout.shipping',
            'checkout.payment',
            'delivery_info',
        ]);

        session(['order_completed' => true, 'last_order_id' => $order?->id]);

        return redirect()->route('confirmation');
    }

    private function buildCartItemsAndTotal(): array
    {
        if (Auth::check()) {
            $cart = Auth::user()->cart;
            if ($cart && $cart->isExpired()) {
                $cart->items()->delete();
                $cart->delete();
                $cart = null;
            }
            $cartData = $cart ? $cart->items()->pluck('qty', 'product_id')->toArray() : [];
        } else {
            $cartData = session('cart', []);
        }

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
                $rawQty = is_array($item) ? ($item['qty'] ?? 1) : $item;
                $qty = max(1, (int) $rawQty);
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

    /**
     * Zlúči hosťov košík s DB košíkom pri prihlásení.
     * Ak sa zhodujú produkty, sčítame množstvá. Ak je na sklade nedostatočne, berieme max.
     */
    public static function mergeGuestCartToDB(): void
    {
        if (!Auth::check()) {
            return;
        }

        $guestCart = session('cart', []);
        if (empty($guestCart)) {
            session()->forget('cart');
            return;
        }

        $user = Auth::user();
        $userCart = $user->cart;

        // Ak user nemá košík, vytvor nový
        if (!$userCart) {
            $userCart = Cart::create([
                'user_id' => $user->id,
                'expires_at' => now()->addDays(30),
            ]);
        } else {
            // Osvež expirácaju existujúceho košíka
            $userCart->refreshExpiration();
        }

        // Zlúč položky
        foreach ($guestCart as $productId => $item) {
            $product = Product::find($productId);
            if (!$product) {
                continue; // Produkt už nie je k dispozícii
            }

            $qty = max(1, (int) $item['qty']);
            $existingItem = $userCart->items()->where('product_id', $productId)->first();

            if ($existingItem) {
                // Produkt je už v DB košíku - sčítaj množství
                $newQty = $existingItem->qty + $qty;
                $newQty = min($newQty, $product->stock); // Respektuj stock
                $existingItem->update(['qty' => $newQty]);
            } else {
                // Nový produkt - pridaj do DB
                $qty = min($qty, $product->stock);
                $userCart->items()->create([
                    'product_id' => $productId,
                    'qty' => $qty,
                ]);
            }
        }

        // Zmaž hosťov košík zo session
        session()->forget('cart');
    }
}
