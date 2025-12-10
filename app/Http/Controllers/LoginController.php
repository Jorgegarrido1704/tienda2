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
        // registro de logins
        $username = $request->input('username');
        $password = $request->input('password');
        $logins = login::where('username', '=', $username)
            ->where('password', '=', $password)
            ->first();
        if ($logins) {
            // Guardar datos en la sesión
            session(['username' => $logins->username, 'role' => $logins->role]);

            return redirect()->route('/welcome');
        } else {
            return view('login.index', ['error' => 'Credenciales inválidas']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function logout(Request $request)
    {
        //
        $request->session()->flush();
    }
}
