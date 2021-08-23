<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Description;
use App\Notifications\PasswordResetNotification;
use Str, DB;
use App\Models\User;


class ForgotController extends Controller
{

    //formulaire d\'oublie du mot de passe
    public function index()
    {

        $data = [
            'title' => $description = 'Oublie de mot de passe - '.config('app.name'),
            'description' => $description,
        ];

        return view('auth.forgot', $data);

    }

    //vérification des données et envoi de lien par email
    public function  store()
    {

        request()->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::uuid();

        DB::table('password_resets')->insert([
            'email'=> request('email'),
            'token' =>$token,
            'created_at' => now(),
        ]);

        //envoi de notification avec lien sécurisé

        $user = User::whereEmail(request('email'))->firstOrFail();

        $user->notify(new PasswordResetNotification($token));

        $success = 'Vérifier votre boite email et suivez les instructions.';
        return back()->withSuccess($success);

    }

}
