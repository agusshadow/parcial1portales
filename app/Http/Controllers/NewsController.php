<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

/**
 * Controlador para la visualización pública de noticias
 * 
 * Este controlador gestiona la presentación de noticias en el frontend
 * del sitio, permitiendo a los usuarios ver listados y detalles de noticias.
 */
class NewsController extends Controller
{
    /**
     * Muestra un listado de todas las noticias disponibles
     * 
     * Recupera todas las noticias de la base de datos y las pasa
     * a la vista para su visualización en la página pública.
     *
     * @return \Illuminate\View\View Vista con el listado de noticias
     */
    public function index()
    {
        $news = News::all();
        return view('news.index', compact('news'));
    }

    /**
     * Muestra el formulario para crear una nueva noticia
     * 
     * Nota: Este método debería estar protegido o en un controlador admin
     * si solo los administradores pueden crear noticias.
     *
     * @return \Illuminate\View\View Vista del formulario de creación
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Muestra los detalles de una noticia específica
     * 
     * Recupera una noticia por su ID y muestra su contenido completo,
     * incluyendo título, descripción, imagen y enlaces relacionados.
     *
     * @param  int  $id  ID de la noticia a mostrar
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse Vista con los detalles de la noticia o redirección en caso de error
     */
    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('news.show', compact('news'));
    }
}