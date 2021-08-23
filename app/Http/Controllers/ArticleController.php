<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Article,
    Category,
};

use Str, Auth ;
use App\Http\Requests\ArticleRequest;


class ArticleController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
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

        $categories = Category::get();

        $data = [
            'title' => $description = 'Ajouter un nouvel article',
            'description' => $description,
            'categories' => $categories,
        ];

        //formulaire de création d'un article
        return view('article.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {

        $validatedData = $request->validated();
        $validatedData['category_id'] = request('category', null);
        Auth::user()->articles()->create($validatedData);


        /*
        $article = Auth::user()->articles()->create(request()->validate([
            'title' => ['required', 'max:20', 'unique:articles,title'],
            'content' => ['required'],
            'category' => ['sometimes', 'nullable', 'exists:categories,id'],
        ]));

        $article->category_id = request('category', null);
        $article->save();
        */

        /*
        $article = Article::create([
            'user_id' =>auth()->id(),
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'content' => (request('content')),
            'category_id' => request('category', null),
        ]);*/



        // sauvegarde d'un article
        //$article = new Article;

/*        $article->user_id = Auth::id();
        $article->category_id = request('category', null);
        $article->title = request('title');
        $article->slug = Str::slug($article->title);
        $article->content = request('content');
        $article->save();*/

        $success = 'Article ajouté';
        return back()->withSuccess($success);

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
