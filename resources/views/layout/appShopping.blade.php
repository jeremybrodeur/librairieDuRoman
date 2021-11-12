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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
</head>
<body>
    <header id="navBar">
        <div class="container">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-md navbar-light">

                <a class="navbar-brand ml-3" href="/">
                    <img src="{{ asset('img/book.png') }}" height="30" alt="mdb logo">
                </a>

                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav11"
                    aria-controls="basicExampleNav11" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="collapse navbar-collapse" id="basicExampleNav11">

                    <!-- Right -->
                    <ul class="navbar-nav ml-auto mr-2">
                        <li class="nav-item">
                            <a href="/shopping/cart" class="nav-link navbar-link-2 waves-effect">
                                <i class="fas fa-shopping-cart pl-0"></i>
                                <span class="badge badge-danger" id="badge">{{Session::get('cartCount')}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.books') }}" class="nav-link waves-effect">
                                Shop
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link waves-effect">
                                Contact
                            </a>
                        </li>
                        @if (Session::has('LoggedUser'))
                            <li class="nav-item">
                                <a class="nav-link waves-effect" href="{{ route('auth.logout') }}">Logout</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('auth.login') }}" class="nav-link waves-effect">
                                    Sign in
                                </a>
                            </li>
                            <li class="nav-item pl-2 mb-2 mb-md-0">
                                <a href="{{ route('auth.register') }}" type="button"
                                    class="nav-link waves-effect">Sign up</a>
                            </li>
                        @endif
                    </ul>

                </div>
                <!-- Links -->

            </nav>
        </div>
        <!-- Navbar -->
    </header>
    @yield('content')
    <footer class="text-center mt-5">

        <p> © Copyright 2021 | 1234 rue du Roman, Gatineau, Qc </p>
    </footer>
    <script src="{{ asset('bootstrap/js/script.js') }}"></script>
</body>

</html>
