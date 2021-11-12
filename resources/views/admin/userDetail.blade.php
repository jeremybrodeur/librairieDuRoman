@extends('layout.appLogged')
@section('content')
    <div class="container mt-5">
        @if (Session::get('UserType') == 1)
            <form method="POST" action="/admin/update/{{ $user->id }}">
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
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}">
                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input readonly class="form-control" type="email" name="username" id="username" value="{{ $user->username }}">
                        <span class="text-danger">@error('username'){{ $message }}@enderror</span>

                        </div>
                        <div class="form-group">
                            <label for="password">Role</label>
                            <select class="form-control" name="isAdmin" id="isAdmin">
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>
                            <span class="text-danger">@error('password'){{ $message }}@enderror</span>

                            </div>
                            <input class="btn btn-light shadow" type="submit" value="Confirmer">
                            <a class="btn btn-dark shadow" href="/admin/deleteUser/{{$user->id}}">Supprimer</a>
                        </form>
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
                    <script>
                        var inputSelect = document.getElementsByTagName("option");
                        for (let i = 0; i < inputSelect.length; i++) {
                            if (inputSelect[i].value == "{{$user->isAdmin}}") {
                                console.log(inputSelect[i].value);
                                inputSelect[i].selected = true;
                            }
                        }
                    </script>
                </div>
            @endsection
