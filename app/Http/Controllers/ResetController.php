<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;


class ResetController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    //redéfinition du mot de passe
    public function index(string $token)
    {

        $password_reset = DB::table('password_resets')->where('token', $token)->first();

        abort_if(!$password_reset, 403);


        $data = [
            'title' => $description = 'Reinitialisation du mot de passe - '.config('app.name'),
            'description' => $description,
            'password_reset' => $password_reset,
        ];

        return view('auth.reset', $data);

    }


    //traitement de la réinitialisation du mot de passe
    public function reset()
    {

        request()->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password'=>'required|between:8,140|confirmed',
        ]);

        if(! DB::table('password_resets')
            ->where('email', request('email'))
            ->where('token', request('token'))->count()
        ){
            $error = 'Vérifiez l\' adresse email';
            return back()->withError($error)->withInput();
        };

        $user = User::whereEmail(request('email'))->firstOrFail();
        $user->password = bcrypt(request('password'));
        $user->save();

        DB::table('password_resets')->where('email', request('email'))->delete();

        $success = 'Votre mot de passe a été modifié.';
        return redirect()->route('login')->withSuccess($success);

    }

}
