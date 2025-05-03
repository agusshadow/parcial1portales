<?php

namespace App\Http\Controllers\Admin;

use App\Models\Platform;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function index()
    {
        try {
            $platforms = Platform::withCount('products')->get();
            return view('admin.platforms.index', compact('platforms'));
        } catch (\Exception $e) {
            return redirect()->route('admin.platforms.index')
                ->with('error', 'No se pudo cargar la lista de plataformas.');
        }
    }

    public function create()
    {
        return view('admin.platforms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2',
        ], [
            'name.required' => 'El nombre de la plataforma es obligatorio.',
            'name.min' => 'El nombre debe tener al menos :min caracteres.'
        ]);

        try {
            Platform::create($validated);

            return redirect()->route('admin.platforms.index')
                ->with('success', 'Plataforma creada con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al crear la plataforma.');
        }
    }

    public function edit($id)
    {
        try {
            $platform = Platform::findOrFail($id);
            return view('admin.platforms.edit', compact('platform'));
        } catch (\Exception $e) {
            return redirect()->route('admin.platforms.index')
                ->with('error', 'No se pudo cargar la plataforma para editar.');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:2',
        ], [
            'name.required' => 'El nombre de la plataforma es obligatorio.',
            'name.min' => 'El nombre debe tener al menos :min caracteres.'
        ]);

        try {
            $platform = Platform::findOrFail($id);
            $platform->update($validated);

            return redirect()->route('admin.platforms.index')
                ->with('success', 'Plataforma actualizada con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al actualizar la plataforma.');
        }
    }

    public function destroy($id)
    {
        try {
            $platform = Platform::findOrFail($id);
            $platform->delete();

            return redirect()->route('admin.platforms.index')
                ->with('success', 'Plataforma eliminada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.platforms.index')
                ->with('error', 'No se pudo eliminar la plataforma.');
        }
    }

    public function confirmDelete($id)
    {
        try {
            $platform = Platform::findOrFail($id);
            return view('admin.platforms.confirm-delete', compact('platform'));
        } catch (\Exception $e) {
            return redirect()->route('admin.platforms.index')
                ->with('error', 'No se pudo cargar la plataforma para confirmar la eliminación.');
        }
    }
}
