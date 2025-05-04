<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Gender;
use App\Models\Platform;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Controlador para la administración de productos
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas
 * con los productos en el panel de administración, incluyendo la gestión
 * de imágenes, precios, géneros y plataformas.
 */
class ProductController extends Controller
{
    /**
     * Muestra una lista de todos los productos
     * 
     * Carga la relación con género y plataforma para mostrar
     * información completa en la tabla de productos
     * 
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * Muestra el formulario para crear un nuevo producto
     * 
     * Carga las listas de géneros y plataformas disponibles para
     * permitir su selección en el formulario
     * 
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * Almacena un nuevo producto en la base de datos
     * 
     * Procesa la validación del formulario, la carga de imagen si existe,
     * y guarda el producto en la base de datos
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Muestra el formulario para editar un producto existente
     *
     * Carga el producto seleccionado y las listas de géneros y plataformas
     * disponibles para permitir su edición
     *
     * @param  int  $id  ID del producto a editar
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * Actualiza un producto específico en la base de datos
     *
     * Valida y procesa los datos del formulario, actualiza la imagen si se
     * proporciona una nueva, y guarda los cambios en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID del producto a actualizar
     * @return \Illuminate\Http\RedirectResponse
     */
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
                    // Eliminar la imagen anterior si existe
                    if ($product->image && Storage::disk('public')->exists($product->image)) {
                        Storage::disk('public')->delete($product->image);
                    }
                    
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

    /**
     * Elimina un producto específico de la base de datos
     *
     * También elimina la imagen asociada si existe
     *
     * @param  int  $id  ID del producto a eliminar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            
            // Eliminar la imagen asociada si existe
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            $product->delete();

            return redirect()->route('admin.products.index')
                ->with('success', 'Producto eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'No se pudo eliminar el producto.');
        }
    }

    /**
     * Muestra una pantalla de confirmación para eliminar un producto
     *
     * @param  int  $id  ID del producto a eliminar
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
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