<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Controlador para la administración de usuarios
 * 
 * Gestiona la visualización y operaciones relacionadas con los usuarios
 * del sistema desde el panel de administración.
 */
class UserController extends Controller
{
    /**
     * Muestra un listado de todos los usuarios
     *
     * Recupera todos los usuarios de la base de datos y los pasa
     * a la vista para su visualización en formato de tabla o lista
     *
     * @return \Illuminate\View\View Vista con el listado de usuarios
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}