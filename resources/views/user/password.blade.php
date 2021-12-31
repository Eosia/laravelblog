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
                    Modifier mon mot de passe
                </div>
                <div class="card-body">

                    <form action="{{ route('update.password') }}" method="post">

                    @csrf

                    <!--formulaire de mise à jour du mot de passe de l'utilisateur-->
                        <div class="form-group">
                            <label for="current">Mot de passe actuel</label>
                            <input type="password" name="current" class="form-control">
                            @error('current')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Nouveau mot de passe</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Co nfirmez le mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary my-3">Modifier</button>
                    </form>

                    <p class="mt-2">
                        <a href="{{ route('user.edit') }}">
                            Revenir à mon compte
                        </a>
                    </p>

                </div>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

    </div>


@endsection
