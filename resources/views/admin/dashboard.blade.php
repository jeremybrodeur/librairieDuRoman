@extends('layout.appLogged')
@section('content')
    <div id='dashboard' class="container mt-5">
        @if (Session::get('UserType') == 1)
            <h4 class="mb-4">Welcome back, {{ Session::get('username') }}!</h4>
            <div class="row">
            <div class="card shadow col-5 mr-2" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Livres</h5>
                  <p class="card-text">Il y a présentement {{ $bookTable }} livres dans la librairie.</p>
                  <a href="{{route('admin.manageBooks')}}" class="card-link">Gestion des livres</a>
                </div>
              </div>
              <div class="card shadow col-6" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Usagers</h5>
                  <p class="card-text">Il y a présentement {{ $userTable }} usagers d'inscrits.</p>
                  <a href="{{route('admin.manageUser')}}" class="card-link">Gestion des usagers</a>
                </div>
              </div>
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
