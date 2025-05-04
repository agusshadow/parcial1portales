<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Gender;
use App\Models\Platform;

/**
 * Controlador para la visualización pública de productos
 * 
 * Este controlador gestiona la presentación de productos en el frontend
 * del sitio, permitiendo a los usuarios ver catálogos de productos
 * y detalles específicos de cada producto.
 */
class ProductController extends Controller
{
    /**
     * Muestra un listado de productos con filtros opcionales
     * 
     * Recupera productos de la base de datos, aplicando filtros por género
     * y plataforma si se especifican en la solicitud. También carga las relaciones
     * necesarias para mostrar información completa de cada producto.
     *
     * @return \Illuminate\View\View Vista con el listado de productos filtrados
     */
    public function index()
    {
        $filters = request()->only(['gender', 'platform']);

        $query = Product::with(['gender', 'platform']);

        $filterMap = [
            'gender' => 'gender_id',
            'platform' => 'platform_id',
        ];

        foreach ($filters as $key => $value) {
            if (!empty($value) && isset($filterMap[$key])) {
                $query->where($filterMap[$key], $value);
            }
        }

        $products = $query->get();

        $genders = Gender::all();
        $platforms = Platform::all();

        return view('products.index', compact('products', 'genders', 'platforms'));
    }

    /**
     * Muestra los detalles de un producto específico
     * 
     * Recupera un producto por su ID y muestra su información detallada,
     * incluyendo género, plataforma, descripción, precio e imagen.
     *
     * @param  int  $id  ID del producto a mostrar
     * @return \Illuminate\View\View Vista con los detalles del producto
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si el producto no existe
     */
    public function show(int $id)
    {
        $product = Product::with(['gender', 'platform'])->findOrFail($id);
        return view('products.show', compact('product'));
    }
}