<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news.index', compact('news'));
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

        return redirect()->route('news.index')
        ->with('success', 'Noticia creada exitosamente.');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'links' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'content', 'links']);

        if ($request->hasFile('image_file')) {
            $path['images'] = $request->file('image_file')->store('images', 'public');
        }

        $news->update($data);

        return redirect()->route('news.show', $news->id)
            ->with('success', 'Noticia actualizada exitosamente');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'Noticia eliminada exitosamente');
    }
}
