<?php

namespace App\Http\Controllers;

class AbonoController extends Controller
{
    //
    public function index()
    {
        //
        $user = session('username');
        $role = session('role');
        if (! $user) {
            return redirect()->route('login.index');
        }

        return view('abonos.abonos', [
            'user' => $user,
            'role' => $role,
        ]);
    }

    public function datos()
    {
        //
    }

    public function store()
    {
        //
    }
}
