<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    // form de connexion
    public function index ()
    {

        $data = [
            'title' => 'Login - '.config('app.name'),
            'description' => 'Connexion à votre compte - '.config('app.name'),
        ];

        return view('auth.login', $data);
    }

    // traitement du login
    public function login()
    {

        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = request()->has('remember');

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')], $remember)) {
            // The user is being remembered...

            return redirect('/');
        }

        return back()->withError('Mauvais identifiants')->withInput();

    }


}
