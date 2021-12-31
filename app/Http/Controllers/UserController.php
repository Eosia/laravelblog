<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Storage, Image, Str;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except('profile');
    }

    // gestion du profil de l'utilisateur
    public function profile(User $user)
    {
        return 'mon nom est '.$user->name;
    }

    // formulaire de mise à jour des infos de l'user connecté
    public function edit() {
        $user = auth()->user();
        $data = [
          'title' => $description = 'Editer mon profil',
          'description' => $description,
          'user' => $user,
        ];
        return view('user.edit', $data);
    }

    public function store()
    {
        $user = auth()->user();
        request()->validate([
            'name' => ['required', 'min:3', 'max:50', Rule::unique('users')->ignore($user)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'avatar' => ['sometimes','nullable' ,'file', 'image', 'mimes:jpeg,png']
        ]);

        if(request()->hasFile('avatar') && request()->file('avatar')->isValid()) {
            $ext = request()->file('avatar')->extension();
            $filename = Str::slug($user->name).'-'.$user->id.'.'.$ext;
            $path = request()->file('avatar')->storeAs('avatar/'.$user->id, $filename);

            $thumbnailImage = Image::make(request()->file('avatar'))->fit(200, 200, function($constraint) {
                $constraint->upsize();
            });

        }
    }

}
