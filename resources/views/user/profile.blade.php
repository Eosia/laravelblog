@extends('layouts.main')

@section('content')

    <div class="row">

        <div class="col-lg-3">

            @include('includes.sidebar')

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9 mt-5">

            <h3 class="text-primary">
                Profil de {{ $user->name }}
            </h3>

            @if($user->avatar)
                <div class="mb-2">
                    <a href="{{ $user->avatar->url }}" target="_blank">
                        <img src="{{ $user->avatar->thumb_url }}" alt="Avatar de {{ $user->name }}" width="200" height="200">
                    </a>
                </div>
            @endif

            {{-- Début du post --}}
            @forelse($articles as $article)

                <div class="card mt-4">
                    <div class="card-body">
                        <h2 class="card-title">
                            <a href="{{ route('articles.show', ['article' => $article->slug]) }}">
                                {{ $article->title }}
                            </a>
                        </h2>

                        <p class="card-text">
                            {{ Str::limit($article->content, 50) }}
                        </p>

                        <span class="auhtor">Par <a href="{{ route('user.profile', ['user' => $article->user->id]) }}">{{ $article->user->name }}</a>
                        Inscrit le {{ $article->user->created_at->format('d/m/Y') }}</span> <br>
                        <span class="time">Posté {{ $article->created_at->diffForHumans() }}</span>

                        <div class="text-right">
                            {{ $article->comments_count }} commentaires
                        </div>

                        @if(Auth::check() && Auth::user()->id == $article->user_id)
                            <div class="author mt-4">
                                <a href="{{ route('articles.edit', ['article' => $article->slug]) }}" class="btn btn-info">Modifier</a> &nbsp;

                                <form style="display: inline;" action="{{ route('articles.destroy', ['article' => $article->slug]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"> X</button>

                                </form>
                            </div>
                        @endif

                    </div>
                </div>

            @empty
                <div class="card mt-4">
                    <div class="card-body">
                        <p>
                            Aucun article
                        </p>
                    </div>
                </div>

            @endforelse
            {{-- Fin du post --}}

            {{-- pagination --}}
            <div class="pagination mx-auto my-5">
                {{ $articles->links() }}
            </div>


        </div>
        <!-- /.col-lg-9 -->

    </div>


@endsection
