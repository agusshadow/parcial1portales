<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Gender;
use App\Models\Platform;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['gender', 'platform'])->get();
        return view('admin.products.index', compact('products'));
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
            'name' => 'required|string|min:2|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string|max:255',
            'description' => 'required|string|min:10',
            'gender_id' => 'required|exists:genders,id',
            'platform_id' => 'required|exists:platforms,id',
        ], [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.min' => 'El nombre debe tener al menos :min caracteres.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'description.required' => 'La descripción es obligatoria.',
            'description.min' => 'La descripción debe tener al menos :min caracteres.',
            'gender_id.required' => 'Debes seleccionar un género.',
            'gender_id.exists' => 'El género seleccionado no existe.',
            'platform_id.required' => 'Debes seleccionar una plataforma.',
            'platform_id.exists' => 'La plataforma seleccionada no existe.'
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Producto creado con éxito.');
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
            'name' => 'required|string|min:2|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string|max:255',
            'description' => 'required|string|min:10',
            'gender_id' => 'required|exists:genders,id',
            'platform_id' => 'required|exists:platforms,id',
        ], [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.min' => 'El nombre debe tener al menos :min caracteres.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'description.required' => 'La descripción es obligatoria.',
            'description.min' => 'La descripción debe tener al menos :min caracteres.',
            'gender_id.required' => 'Debes seleccionar un género.',
            'gender_id.exists' => 'El género seleccionado no existe.',
            'platform_id.required' => 'Debes seleccionar una plataforma.',
            'platform_id.exists' => 'La plataforma seleccionada no existe.'
        ]);
        
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado con éxito.');
    }

    public function confirmDelete($id) {
        $product = Product::findOrFail($id);
        return view('admin.products.confirm-delete', compact('product'));
    }
}
