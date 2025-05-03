<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gender;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function index()
    {
        try {
            $genders = Gender::all();
            return view('admin.genders.index', compact('genders'));
        } catch (\Exception $e) {
            return redirect()->route('admin.genders.index')
                ->with('error', 'No se pudo cargar la lista de géneros.');
        }
    }

    public function create()
    {
        return view('admin.genders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255|unique:genders,name',
        ], [
            'name.required' => 'El nombre del género es obligatorio.',
            'name.min' => 'El nombre debe tener al menos :min caracteres.',
            'name.unique' => 'Ya existe un género con este nombre.'
        ]);

        try {
            Gender::create($validated);
            return redirect()->route('admin.genders.index')
                ->with('success', 'Género creado con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al crear el género.');
        }
    }

    public function edit($id)
    {
        try {
            $gender = Gender::findOrFail($id);
            return view('admin.genders.edit', compact('gender'));
        } catch (\Exception $e) {
            return redirect()->route('admin.genders.index')
                ->with('error', 'No se pudo cargar el género para editar.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $gender = Gender::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|min:2|max:255|unique:genders,name,' . $gender->id,
            ], [
                'name.required' => 'El nombre del género es obligatorio.',
                'name.min' => 'El nombre debe tener al menos :min caracteres.',
                'name.unique' => 'Ya existe un género con este nombre.'
            ]);

            $gender->update($validated);

            return redirect()->route('admin.genders.index')
                ->with('success', 'Género actualizado con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al actualizar el género.');
        }
    }

    public function destroy($id)
    {
        try {
            $gender = Gender::findOrFail($id);

            // Verificamos si hay productos asociados con este género
            if ($gender->products()->count() > 0) {
                return redirect()->route('admin.genders.index')
                    ->with('error', 'No se puede eliminar este género, ya que tiene productos asociados.');
            }

            $gender->delete();

            return redirect()->route('admin.genders.index')
                ->with('success', 'Género eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.genders.index')
                ->with('error', 'Error al eliminar el género.');
        }
    }

    public function confirmDelete($id)
    {
        try {
            $gender = Gender::findOrFail($id);
            return view('admin.genders.confirm-delete', compact('gender'));
        } catch (\Exception $e) {
            return redirect()->route('admin.genders.index')
                ->with('error', 'No se pudo cargar el género para confirmar la eliminación.');
        }
    }
}
