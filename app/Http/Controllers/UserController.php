<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class UserController extends Controller
{
    public function index()
{
    $users = User::all(); // Asegúrate de que no hay errores en esta línea
    return Inertia::render('users/Index', ['users' => $users]);
}

}
