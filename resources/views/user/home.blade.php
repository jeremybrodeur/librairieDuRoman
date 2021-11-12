@extends('layout.appShopping')
@section('content')
    @if (Session::get('failAccess'))
        <div class="alert alert-danger">
            {{ Session::get('failAccess') }}
        </div>
    @endif
    @if (Session::get('failAccessAdmin'))
        <div class="alert alert-danger">
            {{ Session::get('failAccessAdmin') }}
        </div>
    @endif
    <div class=" container text-center mt-5">
        <h1>Librairie du Roman</h1>
        <p>
            Pour tout vos achats de livres, vous pouvez compter sur nous!
        </p><br>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Fusce bibendum volutpat imperdiet. Sed tortor nulla, aliquam at risus a, sagittis hendrerit lacus. Morbi
            iaculis, magna sit amet placerat iaculis, elit magna tristique orci, in hendrerit nisl nulla vitae ligula. Lorem
            ipsum dolor sit amet, consectetur adipiscing elit.
            Aenean eleifend pharetra tincidunt. Quisque efficitur sagittis congue. Nunc pulvinar odio vel risus lobortis
            vestibulum. Aenean nec neque nunc.
            Aliquam vel nisl nec nibh suscipit tempor. In maximus felis non accumsan cursus. Aliquam ac blandit nunc. Proin
            viverra egestas ante.
            Mauris consequat fringilla faucibus. Morbi nibh neque, faucibus nec congue a, fringilla in urna. Integer rutrum
            ligula sit amet dolor fringilla, sed congue sem cursus.
        </p>
        <a class="btn btn-dark shadow" href="/shopping/books">Nos livres</a>
    </div>
    
@endsection
