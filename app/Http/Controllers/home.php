<?php

namespace App\Http\Controllers;

class home extends Controller
{
    //
    public function index()
    {
        $user = session('username');
        $role = session('role');
        if (! $user) {
            return redirect()->route('login.index');
        }

        return view('home.home');
    }
}
