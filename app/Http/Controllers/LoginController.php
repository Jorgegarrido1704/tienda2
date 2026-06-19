<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Services\BackupService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome', ['error' => 'Credenciales inválidas']);
    }

    public function login(Request $request)
    {
        $username = $request->input('user');
        $password = $request->input('pass');

        $logins = login::where('username', '=', $username)
            ->where('password', '=', $password)
            ->first();

        if ($logins) {
            session(['username' => $logins->username, 'role' => $logins->role]);

            // Respaldo de la BD al iniciar sesión
            app(BackupService::class)->run('login');

            return redirect()->route('home.index');
        } else {
            return view('welcome', ['error' => 'Credenciales inválidas']);
        }
    }

    public function logout(Request $request)
    {
        // Respaldo de la BD antes de cerrar sesión
        app(BackupService::class)->run('logout');

        $request->session()->flush();

        return redirect()->route('login.index');
    }
}
