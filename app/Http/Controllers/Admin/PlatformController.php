<?php

namespace App\Http\Controllers\Admin;

use App\Models\Platform;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controlador para la administración de plataformas
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas
 * con las plataformas de productos en el panel de administración.
 */
class PlatformController extends Controller
{
    /**
     * Muestra una lista de todas las plataformas
     * 
     * Incluye un contador de productos asociados a cada plataforma
     * 
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * Muestra el formulario para crear una nueva plataforma
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.platforms.create');
    }

    /**
     * Almacena una nueva plataforma en la base de datos
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Muestra el formulario para editar una plataforma existente
     *
     * @param  int  $id  ID de la plataforma a editar
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * Actualiza una plataforma específica en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID de la plataforma a actualizar
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Elimina una plataforma específica de la base de datos
     *
     * @param  int  $id  ID de la plataforma a eliminar
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Muestra una pantalla de confirmación para eliminar una plataforma
     *
     * @param  int  $id  ID de la plataforma a eliminar
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
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