@extends('layout.appLogged')
@section('content')
    @if (Session::get('UserType') == 1)
        <div class="container mt-5">
            <h4 class="mt-4 mb-4">Remplissez les champs pour ajouter un nouveau livre</h4>
                <form action="/admin/createBookPost" method="POST" id="formLivre" name="formLivre">
                @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                @csrf
                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn">
                    <span class="text-danger">@error('isbn'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="auteur">Auteur(e)</label>
                    <input type="text" class="form-control" id="auteur" name="auteur">
                    <span class="text-danger">@error('auteur'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre">
                    <span class="text-danger">@error('titre'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="prix">Prix</label>
                    <input type="text" class="form-control" id="prix" name="prix">
                    <span class="text-danger">@error('prix'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="quantite">Quantite</label>
                    <input type="text" class="form-control" id="quantite" name="quantite">
                    <span class="text-danger">@error('quantite'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="text" class="form-control" id="photo" name="photo">
                    <span class="text-danger">@error('photo'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="resume">Resume</label>
                    <input type="text" class="form-control" id="resume" name="resume">
                    <span class="text-danger">@error('resume'){{ $message }}@enderror</span>
                </div>
                <input type="submit" class="btn btn-dark shadow" value="Confirmer">
            </form>
        </div>
    @else

        @if (Session::get('LoggedUser') != null)
            {{ Session::put('failAccessAdmin', 'You are not authorized to access this page!') }}
            <script>
                window.location = "/user/home"
            </script>
        @else
            {{ Session::put('failAccess', 'You need to be logged in to access this page!') }}
            <script>
                window.location = "/auth/login"
            </script>
        @endif
    @endif
    </div>
@endsection
