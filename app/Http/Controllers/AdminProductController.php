<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images', 'category.parent')->orderByDesc('id')->get();
        return view('admin-products', compact('products'));
    }

    public function form($id = null)
    {
        $product = null;
        if ($id) {
            $product = Product::with('images')->findOrFail($id);
        }
        $categories = Category::with('parent')->get();
        return view('admin-form', compact('product', 'categories'));
    }

    public function save(Request $request, $id = null)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'season' => 'nullable|string',
            'width' => 'nullable|integer',
            'profile' => 'nullable|integer',
            'diameter' => 'nullable|string',
            'has_spikes' => 'nullable',
            'images' => $id ? 'nullable|array' : 'required|array|min:2',
            'images.*' => 'image',
        ]);

        $validated['has_spikes'] = $request->has('has_spikes');

        $product = $id ? Product::findOrFail($id) : new Product();
        $product->fill($validated);
        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/products'), $filename);
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'images/products/' . $filename,
                    'is_main' => ($id === null && $index === 0) ? true : false,
                ]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Produkt uložený.');
    }

    public function deleteImage($imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        $wasMain = $image->is_main;
        $productId = $image->product_id;

        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }
        $image->delete();

        if ($wasMain) {
            $next = ProductImage::where('product_id', $productId)->first();
            if ($next) {
                $next->update(['is_main' => true]);
            }
        }

        return back()->with('success', 'Fotografia bola vymazaná.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if ($product->orderItems()->count() > 0) {
            return redirect()->route('admin.products')
                   ->with('error', 'Tento produkt nie je možné vymazať, pretože je súčasťou histórie objednávok.');
        }

        foreach ($product->images as $image) {
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }
            $image->delete();
        }
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Produkt bol vymazaný.');
    }
}
