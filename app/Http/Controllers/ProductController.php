<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Gender;
use App\Models\Platform;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['gender', 'platform'])->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $genders = Gender::all();
        $platforms = Platform::all();

        return view('admin.products.create', compact('genders', 'platforms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'gender_id' => 'required|exists:genders,id',
            'platform_id' => 'required|exists:platforms,id',
        ]);

        $productData = [
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'gender_id' => $validated['gender_id'],
            'platform_id' => $validated['platform_id'],
            'image' => 'default.jpg',
        ];

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $productData['image'] = $path;
        }

        Product::create($productData);

        return redirect()->route('products.index')->with('success', 'Producto creado con éxito.');
    }

    public function show($id)
    {
        $product = Product::with(['gender', 'platform'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $genders = Gender::all();
        $platforms = Platform::all();

        return view('admin.products.edit', compact('product', 'genders', 'platforms'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required|string',
            'gender_id' => 'required|exists:genders,id',
            'platform_id' => 'required|exists:platforms,id',
        ]);

        $productData = [
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'gender_id' => $validated['gender_id'],
            'platform_id' => $validated['platform_id'],
        ];

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $productData['image'] = $path;
        }

        $product->update($productData);

        return redirect()->route('products.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado con éxito.');
    }

    public function confirmDelete($id) {
        $product = Product::findOrFail($id);
        return view('admin.products.confirm-delete', compact('product'));
    }
}
