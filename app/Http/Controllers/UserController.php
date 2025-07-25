<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Muestra la vista de perfil de usuario
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Muestra la vista para editar el perfil de usuario
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        try {
            $user = Auth::user();
            return view('user.edit', compact('user'));
        } catch (\Exception $e) {
            return redirect()->route('user.profile')->with('error', 'No se pudo cargar la edición de perfil.');
        }
    }

    /**
     * Actualiza los datos del perfil de usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $user->update($request->only('name'));
            return redirect()->route('user.profile')->with('success', 'Datos actualizados');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'No se pudieron actualizar los datos.');
        }
    }

    /**
     * Muestra el formulario para cambiar la contraseña
     *
     * @return \Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        try {
            return view('user.change-password');
        } catch (\Exception $e) {
            return redirect()->route('user.profile')->with('error', 'No se pudo cargar el formulario de cambio de contraseña.');
        }
    }

    /**
     * Cambia la contraseña del usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        try {
            $user = Auth::user();
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if (!\Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta']);
            }

            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->route('user.profile')->with('success', 'Contraseña actualizada');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'No se pudo cambiar la contraseña.');
        }
    }
}
