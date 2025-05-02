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
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'links' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'content', 'links']);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('images', 'public');
            $data['images'] = $path;
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'links' => 'nullable|string|max:255',
        ]);
        
        if ($request->hasFile('image_file')) {
            $path['images'] = $request->file('image_file')->store('images', 'public');
        }
        
        $news->update($validated);

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