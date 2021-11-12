<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Accueil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/additional-methods.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
    <script src="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $('.dropdown-toggle').dropdown();
    </script>
    <style>
        /* The container <div> - needed to position the dropdown content */

        /* Dropdown Content (Hidden by Default) */
        

    </style>
</head>

<body>
    @if (Session::get('UserType') == 1)
    <header id="navBar">
        <div id="imgNav" class='d-flex justify-content-center col-12'><img src="{{ asset('img/book.png') }}"
                alt="logo" /></div>
        <ul class=" nav justify-content-center col-12">
            <div class="container row">
                <li class="col-3 nav-item">
                    
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                    <div class="col-3 dropdown mt-2">
                        <a class="dropbtn">Manage books</a>
                        <div class="dropdown-content">
                            <a href="{{route('admin.manageBooks')}}">Inventaire livres</a>
                            <a href="{{route('admin.createBookGet')}}">Ajouter livre</a>
                        </div>
                    </div>
                    <div class="col-3 dropdown mt-2">
                        <a class="dropbtn">Manage user</a>
                        <div class="dropdown-content">
                            <a href="{{route('admin.manageUser')}}">Liste usagers</a>
                            <a href="{{route('admin.create')}}">Ajouter usager</a>
                        </div>
                    </div>
                </li>
                <li class="col-3 nav-item">
                    <a class="nav-link active" href="{{ route('auth.logout') }}">Logout</a>
                </li>
            </div>
        </ul>
    </header>
    @else
        @if (Session::get('LoggedUser') != null)
            {{ Session::put('failAccessAdmin', 'You are not authorized to access this page!') }}
            <script>
                window.location = "/"
            </script>
        @else
            {{ Session::put('failAccess', 'You need to be logged in to access this page!') }}
            <script>
                window.location = "/auth/login"
            </script>
        @endif
    @endif
    @yield('content')
    <footer class="text-center mt-5">

        <p> © Copyright 2021 | 1234 rue du Roman, Gatineau, Qc</p>
    </footer>
    <script src="{{ asset('bootstrap/js/script.js') }}"></script>
</body>

</html>
