<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
  Comment, Article
};
use App\Http\requests\CommentRequest;


class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CommentRequest $request, Article $article)
    {

        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();

        $article->comments()->create($validatedData);

        $success = 'Commentaire ajouté';

        return back()->withSuccess($success);

    }

}