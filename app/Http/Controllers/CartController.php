<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
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

        $cart = session('cart', []);

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

    public function delivery()
    {
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

        $deliveryInfo = session('delivery_info', []);
        $dopravaCena = 1.29; // Hardcoded packeta doprava as per original template
        $totalSUpravou = $total + $dopravaCena;

        return view('summary', compact('cartItems', 'total', 'deliveryInfo', 'totalSUpravou', 'dopravaCena'));
    }
}
