@extends('layouts.main')

@section('content')

    <div class="row">

        <div class="col-lg-3">

            @include('includes.sidebar')

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Début du post --}}

            <div class="card mt-4">

                <div class="card-body">
                    <h2 class="card-title">
                        {{ $article->title }}
                    </h2>

                    <p class="card-text">
                        {{ $article->content }}
                    </p>

                    <span class="auhtor">Par <a
                            href="{{ route('user.profile', ['user' => $article->user->id]) }}">{{ $article->user->name }}</a>
                        Inscrit le {{ $article->user->created_at->format('d/m/Y') }}</span> <br>
                    <span class="time">Posté {{ $article->created_at->diffForHumans() }}</span>
                </div>
            </div>

        {{-- Fin du post --}}

        <!-- /.card -->

            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Commentaires
                </div>
                <div class="card-body">
                    @forelse($comments as $comment)
                    <p>
                        {{ $comment->content }}
                    </p>
                    <small class="text-muted">
                        Publié par:
                        <a href="{{ route('user.profile', ['user' => $comment->user->id]) }}">
                            {{ $comment->user->name }}
                        </a>
                        - Le: {{ $comment->created_at->isoFormat('LLL') }}
                    </small>
                    <hr>
                    @empty
                        <p>Pas encore de commentaire.</p>
                    @endforelse

                    @auth()
                        <form action="{{ route('post.comment', ['article' => $article->slug]) }}" method="post">

                            @csrf

                            <div class="form-group">

                                <label for="content">Laissez un commentaire</label>

                                <textarea class="form-control" name="content" cols="30" rows="5" placeholder="Votre commentaire">
                                {{ old('content') }}
                            </textarea>
                                @error('content')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Commenter</button>
                        </form>
                    @endauth

                    @guest()
                        <a href="{{ route('login') }}" class="btn btn-success">Laisser un commentaire</a>
                    @endguest

                </div>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

    </div>


@endsection
