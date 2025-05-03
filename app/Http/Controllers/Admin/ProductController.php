<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Gender;
use App\Models\Platform;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with(['gender', 'platform'])->get();
            return view('admin.products.index', compact('products'));
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'No se pudo cargar la lista de productos.');
        }
    }

    public function create()
    {
        try {
            $genders = Gender::all();
            $platforms = Platform::all();

            return view('admin.products.create', compact('genders', 'platforms'));
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'No se pudo cargar el formulario de creación.');
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'price' => 'required|numeric|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'image_file.image' => 'El archivo debe ser una imagen.',
            'image_file.mimes' => 'La imagen debe ser de tipo: :values.',
            'image_file.max' => 'La imagen no debe pesar más de 2MB.',
            'gender_id.required' => 'Debes seleccionar un género.',
            'gender_id.exists' => 'El género seleccionado no existe.',
            'platform_id.required' => 'Debes seleccionar una plataforma.',
            'platform_id.exists' => 'La plataforma seleccionada no existe.'
        ]);

        $data = $request->only(['name', 'price', 'description', 'gender_id', 'platform_id']);

        if ($request->hasFile('image_file')) {
            try {
                $path = $request->file('image_file')->store('images', 'public');
                $data['image'] = $path;
            } catch (\Exception $e) {
                return back()->withInput()
                    ->withErrors(['image_file' => 'Error al subir la imagen: ' . $e->getMessage()])
                    ->with('error', 'No se pudo subir la imagen.');
            }
        }

        try {
            Product::create($data);
            return redirect()->route('admin.products.index')
                ->with('success', 'Producto creado con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al crear el producto.');
        }
    }

    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            $genders = Gender::all();
            $platforms = Platform::all();

            return view('admin.products.edit', compact('product', 'genders', 'platforms'));
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'No se pudo cargar el producto para editar.');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'price' => 'required|numeric|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'image_file.image' => 'El archivo debe ser una imagen.',
            'image_file.mimes' => 'La imagen debe ser de tipo: :values.',
            'image_file.max' => 'La imagen no debe pesar más de 2MB.',
            'gender_id.required' => 'Debes seleccionar un género.',
            'gender_id.exists' => 'El género seleccionado no existe.',
            'platform_id.required' => 'Debes seleccionar una plataforma.',
            'platform_id.exists' => 'La plataforma seleccionada no existe.'
        ]);

        try {
            $product = Product::findOrFail($id);

            $data = $request->only(['name', 'price', 'description', 'gender_id', 'platform_id']);

            if ($request->hasFile('image_file')) {
                try {
                    $path = $request->file('image_file')->store('images', 'public');
                    $data['image'] = $path;
                } catch (\Exception $e) {
                    return back()->withInput()
                        ->withErrors(['image_file' => 'Error al subir la imagen: ' . $e->getMessage()])
                        ->with('error', 'No se pudo actualizar la imagen.');
                }
            }
            $product->update($data);

            return redirect()->route('admin.products.index')
                ->with('success', 'Producto actualizado con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->route('admin.products.index')
                ->with('success', 'Producto eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'No se pudo eliminar el producto.');
        }
    }

    public function confirmDelete($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('admin.products.confirm-delete', compact('product'));
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'No se pudo encontrar el producto para eliminar.');
        }
    }
}
