<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class LogoutController extends Controller
{

    //gère la déconnexion
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


}
