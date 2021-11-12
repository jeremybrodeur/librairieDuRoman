@extends('layout.appLogged')
@section('content')
    <div class="container">
        @if (Session::get('UserType') == 1)
            <div class="row">
                <div class="col-md-12 col-md-offset-6 mt-5">
                    <table id="userTable" class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                        </thead>
                        <tbody>
                            @foreach ($allUser as $user)
                                <tr>
                                    <td>
                                        <a href="/admin/manageUser/{{ $user->id }}">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $user->username }}
                                    </td>
                                    <td>
                                        @if ($user->isAdmin == 0)
                                            Usager
                                        @else
                                            Admin
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
