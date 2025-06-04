<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controlador para la administración de usuarios
 *
 * Gestiona las operaciones CRUD para los usuarios desde el panel de administración.
 */
class UserController extends Controller
{
    /**
     * Muestra un listado de todos los usuarios
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            $users = User::paginate(10);
            return view('admin.users.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('error', 'No se pudo cargar la lista de usuarios.');
        }
    }

    /**
     * Muestra el formulario para crear un nuevo usuario
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Almacena un nuevo usuario en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|string',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo debe tener un formato válido.',
            'email.unique' => 'El correo ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'role.required' => 'El rol es obligatorio.',
        ]);

        try {
            $validated['password'] = Hash::make($validated['password']);
            User::create($validated);

            return redirect()->route('admin.users.index')
                ->with('success', 'Usuario creado con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al crear el usuario.');
        }
    }

    /**
     * Muestra el formulario para editar un usuario existente
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.users.edit', compact('user'));
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('error', 'No se pudo cargar el usuario para editar.');
        }
    }

    /**
     * Actualiza un usuario específico en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:2',
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
        ]);

        try {
            $user = User::findOrFail($id);

            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            return redirect()->route('admin.users.index')
                ->with('success', 'Usuario actualizado con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al actualizar el usuario.');
        }
    }

    /**
     * Elimina un usuario específico de la base de datos
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'Usuario eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('error', 'No se pudo eliminar el usuario.');
        }
    }

    /**
     * Muestra una pantalla de confirmación para eliminar un usuario
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function confirmDelete($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.users.confirm-delete', compact('user'));
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('error', 'No se pudo cargar el usuario para confirmar la eliminación.');
        }
    }
}
