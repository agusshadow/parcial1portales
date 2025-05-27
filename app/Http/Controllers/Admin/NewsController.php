<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Controlador para la administración de noticias
 *
 * Este controlador maneja todas las operaciones CRUD relacionadas
 * con las noticias en el panel de administración.
 */
class NewsController extends Controller
{
    /**
     * Muestra una lista de todas las noticias
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            $news = News::paginate(10);
            return view('admin.news.index', compact('news'));
        } catch (\Exception $e) {
            return redirect()->route('admin.news.index')
                ->with('error', 'No se pudo cargar la lista de noticias.');
        }
    }

    /**
     * Muestra el formulario para crear una nueva noticia
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Almacena una nueva noticia en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:2|max:255',
            'content' => 'required|string|min:10',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'links' => 'nullable|string|max:255|url',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.min' => 'El título debe tener al menos :min caracteres.',
            'content.required' => 'El contenido es obligatorio.',
            'content.min' => 'El contenido debe tener al menos :min caracteres.',
            'image_file.image' => 'El archivo debe ser una imagen.',
            'image_file.mimes' => 'La imagen debe ser de tipo: :values.',
            'image_file.max' => 'La imagen no debe pesar más de 2MB.',
            'links.url' => 'El enlace debe ser una URL válida (incluir http:// o https://).'
        ]);

        $data = $request->only(['title', 'content', 'links']);

        if ($request->hasFile('image_file')) {
            try {
                $path = $request->file('image_file')->store('images', 'public');
                $data['images'] = $path;
            } catch (\Exception $e) {
                return back()->withInput()
                    ->withErrors(['image_file' => 'Error al subir la imagen: ' . $e->getMessage()])
                    ->with('error', 'No se pudo subir la imagen.');
            }
        }

        try {
            News::create($data);
            return redirect()->route('admin.news.index')
                ->with('success', 'Noticia creada con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al crear la noticia.');
        }
    }

    /**
     * Muestra el formulario para editar una noticia existente
     *
     * @param  int  $id  ID de la noticia a editar
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        try {
            $news = News::findOrFail($id);
            return view('admin.news.edit', compact('news'));
        } catch (\Exception $e) {
            return redirect()->route('admin.news.index')
                ->with('error', 'No se pudo encontrar la noticia para editar.');
        }
    }

    /**
     * Actualiza una noticia específica en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID de la noticia a actualizar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:2|max:255',
            'content' => 'required|string|min:10',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'links' => 'nullable|string|max:255|url',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.min' => 'El título debe tener al menos :min caracteres.',
            'content.required' => 'El contenido es obligatorio.',
            'content.min' => 'El contenido debe tener al menos :min caracteres.',
            'image_file.image' => 'El archivo debe ser una imagen.',
            'image_file.mimes' => 'La imagen debe ser de tipo: :values.',
            'image_file.max' => 'La imagen no debe pesar más de 2MB.',
            'links.url' => 'El enlace debe ser una URL válida (incluir http:// o https://).'
        ]);

        try {
            $news = News::findOrFail($id);

            $data = $request->only(['title', 'content', 'links']);

            if ($request->hasFile('image_file')) {
                try {
                    // Si existe una imagen previa, eliminarla
                    if ($news->images && Storage::disk('public')->exists($news->images)) {
                        Storage::disk('public')->delete($news->images);
                    }

                    $path = $request->file('image_file')->store('images', 'public');
                    $data['images'] = $path;
                } catch (\Exception $e) {
                    return back()->withInput()
                        ->withErrors(['image_file' => 'Error al subir la imagen: ' . $e->getMessage()])
                        ->with('error', 'No se pudo actualizar la imagen.');
                }
            }

            $news->update($data);

            return redirect()->route('admin.news.index')
                ->with('success', 'Noticia actualizada con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al actualizar la noticia.');
        }
    }

    /**
     * Elimina una noticia específica de la base de datos
     *
     * @param  int  $id  ID de la noticia a eliminar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $new = News::findOrFail($id);
            $new->delete();

            return redirect()->route('admin.news.index')
                ->with('success', 'Noticia eliminada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.news.index')
                ->with('error', 'No se pudo eliminar la noticia.');
        }
    }

        /**
     * Muestra una pantalla de confirmación para eliminar una noticia
     *
     * @param  int  $id  ID de la noticia a eliminar
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function confirmDelete($id)
    {
        try {
            $new = News::findOrFail($id);
            return view('admin.news.confirm-delete', compact('new'));
        } catch (\Exception $e) {
            return redirect()->route('admin.news.index')
                ->with('error', 'No se pudo encontrar la noticia para eliminar.');
        }
    }
}
