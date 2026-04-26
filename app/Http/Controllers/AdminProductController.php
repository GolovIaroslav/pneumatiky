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
        $products = Product::with('images', 'category')->orderByDesc('id')->get();
        return view('admin-products', compact('products'));
    }

    public function form($id = null)
    {
        $product = null;
        if ($id) {
            $product = Product::with('images')->findOrFail($id);
        }
        $categories = Category::all();
        return view('admin-form', compact('product', 'categories'));
    }

    public function save(Request $request, $id = null)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'season' => 'nullable|string',
            'width' => 'nullable|integer',
            'profile' => 'nullable|integer',
            'diameter' => 'nullable|string',
            'has_spikes' => 'nullable',
            'images.*' => 'nullable|image',
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
        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }
        $image->delete();
        return back()->with('success', 'Fotografia bola vymazaná.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
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
