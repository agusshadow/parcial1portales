<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
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
                return back()->withInput()->withErrors(['image_file' => 'Error al subir la imagen: ' . $e->getMessage()]);
            }
        }

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Noticia creada exitosamente.');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        
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
                return back()->withInput()->withErrors(['image_file' => 'Error al subir la imagen: ' . $e->getMessage()]);
            }
        }
        
        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Noticia actualizada exitosamente');
    }

    public function destroy($id)
    {
        $new = News::findOrFail($id);
        $new->delete();

        return redirect()->route('admin.news.index')->with('success', 'noticia eliminada con éxito.');
    }

    public function confirmDelete($id) {
        $new = News::findOrFail($id);
        return view('admin.news.confirm-delete', compact('new'));
    }

}