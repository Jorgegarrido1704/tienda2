<?php

namespace App\Http\Controllers;

use App\Models\login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return view('welcome', ['error' => 'Credenciales inválidas']);

    }

    public function login(Request $request)
    {
        //
        // registro de logins
        $username = $request->input('user');
        $password = $request->input('pass');
        $logins = login::where('username', '=', $username)
            ->where('password', '=', $password)
            ->first();
        if ($logins) {
            // Guardar datos en la sesión
            session(['username' => $logins->username, 'role' => $logins->role]);

            return redirect()->route('home.index');
        } else {
            return view('welcome', ['error' => 'Credenciales inválidas']);
        }
    }

    public function logout(Request $request)
    {
        //
        $request->session()->flush();

        return redirect()->route('login.index');
    }
}
