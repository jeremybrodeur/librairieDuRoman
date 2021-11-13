@extends('layout.appLogged')
@section('content')
    @if (Session::get('UserType') == 1)
        <div class="container mt-5">
            <h4 class="mt-4 mb-4">Remplissez les champs pour ajouter un nouveau utilisateur</h4>
            <form method="POST" action="/admin/createUser" id="formUser" name="formUser">
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
                    <label for="name">Last Name</label>
                    <input class="form-control" type="text" name="lname" id="lname" value="{{ old('lname') }}">
                    <span class="text-danger">@error('lname'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input class="form-control" type="text" name="fname" id="fname" value="{{ old('fname') }}">
                        <span class="text-danger">@error('fname'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" type="email" name="username" id="username" value="{{ old('username') }}">
                            <span class="text-danger">@error('username'){{ $message }}@enderror</span>

                            </div>
                            <div class="form-group">
                                <label for="password">Role</label>
                                <select class="form-control" name="isAdmin" id="isAdmin">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                                <span class="text-danger">@error('isAdmin'){{ $message }}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="username">Password</label>
                                    <input class="form-control" type="password" name="password" id="password">
                                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                    </div>
                                    <input class="btn btn-dark shadow" type="submit" value="Create">
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
                        </div>
                    @endsection
