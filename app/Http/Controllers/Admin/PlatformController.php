<?php

namespace App\Http\Controllers\Admin;

use App\Models\Platform;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::withCount('products')->get();
        return view('admin.platforms.index', compact('platforms'));
    }

    public function create()
    {
        return view('admin.platforms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:platforms,name',
        ]);

        Platform::create($validated);

        return redirect()->route('admin.platforms.index')->with('success', 'Plataforma creada con éxito.');
    }

    public function edit($id)
    {
        $platform = Platform::findOrFail($id);
        return view('admin.platforms.edit', compact('platform'));
    }

    public function update(Request $request, $id)
    {
        $platform = Platform::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:platforms,name,' . $platform->id,
        ]);

        $platform->update($validated);

        return redirect()->route('admin.platforms.index')->with('success', 'Plataforma actualizada con éxito.');
    }

    public function destroy($id)
    {
        $platform = Platform::findOrFail($id);
        $platform->delete();

        return redirect()->route('admin.platforms.index')->with('success', 'Plataforma eliminada con éxito.');
    }

    public function confirmDelete($id)
    {
        $platform = Platform::findOrFail($id);
        return view('admin.platforms.confirm-delete', compact('platform'));
    }
}
