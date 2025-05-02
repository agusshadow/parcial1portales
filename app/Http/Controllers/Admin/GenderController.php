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
        $genders = Gender::all();
        return view('admin.genders.index', compact('genders'));
    }

    public function create()
    {
        return view('admin.genders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genders,name',
        ]);

        Gender::create($validated);

        return redirect()->route('admin.genders.index')->with('success', 'Género creado con éxito.');
    }

    public function edit($id)
    {
        $gender = Gender::findOrFail($id);
        return view('admin.genders.edit', compact('gender'));
    }

    public function update(Request $request, $id)
    {
        $gender = Gender::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genders,name,' . $gender->id,
        ]);

        $gender->update($validated);

        return redirect()->route('admin.genders.index')->with('success', 'Género actualizado con éxito.');
    }

    public function destroy($id)
    {
        $gender = Gender::findOrFail($id);

        // Verificamos si hay productos asociados con este género
        if ($gender->products()->count() > 0) {
            return redirect()->route('admin.genders.index')
                ->with('error', 'No se puede eliminar este género, ya que tiene productos asociados.');
        }

        $gender->delete();

        return redirect()->route('admin.genders.index')->with('success', 'Género eliminado con éxito.');
    }

    public function confirmDelete($id)
    {
        $gender = Gender::findOrFail($id);
        return view('admin.genders.confirm-delete', compact('gender'));
    }
}
