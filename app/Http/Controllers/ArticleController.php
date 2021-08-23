<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Str;

class ArticleController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    //pagination
    protected $perPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //recupère les article par id descendant
        $articles = Article::orderByDesc('id')->paginate($this->perPage);

        $data = [
            'title' => 'Les articles du blog - '.config('app.name'),
            'description' => 'Retrouvez tous les articles de '.config('app.name'),
            'articles' => $articles,
        ];

        return view('article.index', $data);

        //foreach ($articles as $article) {
        //    dump($article->title);
        //}


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return 'Formulaire de création d\'un article';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // sauvegarde d'un article

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
        $data = [
            'title' => $article->title.' - '.config('app.name'),
            'description' => $article->title.' - '.Str::words($article->content, 10),
            'article' => $article,
        ];

        return view('article.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //user authentifié, permet d'éditer un article via form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // mise à jour de l\'article en db
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // supprime l\'article
    }
}
