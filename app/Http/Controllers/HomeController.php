<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;
use App\Models\Product;

/**
 * Controlador para la página principal del sitio
 * 
 * Este controlador se encarga de gestionar la visualización de elementos
 * en la página de inicio, incluyendo plataformas destacadas y productos recientes.
 */
class HomeController extends Controller
{
    /**
     * Muestra la página principal del sitio
     * 
     * Recupera todas las plataformas disponibles y una selección de productos
     * recientes para mostrarlos en la página de inicio. Carga las relaciones
     * de género y plataforma para cada producto.
     *
     * @return \Illuminate\View\View Vista de la página principal con plataformas y productos
     */
    public function index()
    {
        $platforms = Platform::all();
        $products = Product::with(['gender', 'platform'])->take(4)->get();
        return view('home', compact('platforms', 'products'));
    }
}