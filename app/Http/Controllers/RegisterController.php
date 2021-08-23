<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;



class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    // formulaire d\'inscription
    public function index()
    {
        $data = [
            'title' => 'Inscription - '.config('app.name'),
            'description' => 'Inscription sur le site '.config('app.name'),
        ];

        return view('auth.register', $data);
    }

    // traitement du form d\'inscription
    public function register(Request $request)
    {
        request()->validate([
            'name'=>'required|min:3|max:191|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|between:8,140',
        ]);

        $user = new User;

//        $user->name = $request->name;
//        $user->email = $request->email;
//        $user->password = bcrypt($request->pasword);

        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));


        $user->save();

        $success = 'Inscription terminée.';

        return back()->withSuccess($success);

    }

}
