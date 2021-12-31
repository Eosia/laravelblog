@extends('layouts.main')

@section('content')

    <div class="row">

        <div class="col-lg-3">

            @include('includes.sidebar')

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Bonjour {{ $user->name }}
                </div>
                <div class="card-body">


                    <form action="{{ route('post.user') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        <!--formulaire de mise à jour des données de l'utilisateur-->
                        <div class="form-group">
                            <label for="name">Nom d'utilisateur</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                            @error('name')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                            @error('email')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="avatar">Mon avatar</label>
                            <br>
                            <input type="file" name="avatar">
                            @error('avatar')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(!empty($user->avatar->filename))
                            <div class="mb-2">
                                <a href="{{ $user->avatar->url }}" target="_blank">
                                    <img src="{{ $user->avatar->thumb_url }}" alt="{{ $user->avatar->filename }}" width="200" height="200">
                                </a>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary my-3">Envoyer</button>
                    </form>

                    <p class="mt-2">
                        <a href="#">
                            Modifier mon mot de passe
                        </a>
                    </p>

                </div>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

    </div>


@endsection
