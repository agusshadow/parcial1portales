<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        try {
            $news = News::all();
            return view('admin.news.index', compact('news'));
        } catch (\Exception $e) {
            return redirect()->route('admin.news.index')
                ->with('error', 'No se pudo cargar la lista de noticias.');
        }
    }

    public function create()
    {
        return view('admin.news.create');
    }

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
