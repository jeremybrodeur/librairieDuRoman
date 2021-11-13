@extends('layout.app')
@section('content')
    @if(Session::has('LoggedUser'))
        @if(Session::get('UserType')==0)
            <script>window.location = "/"</script> 
        @else 
            <script>window.location = "/admin/dashboard"</script>
        @endif
    @else
        @if(Session::get('failAccess'))
                        <div class="alert alert-danger">
                            {{Session::get("failAccess")}}
                        </div>
        @endif
        @if(Session::get('failAccessAdmin'))
                        <div class="alert alert-danger">
                            {{Session::get("failAccessAdmin")}}
                        </div>
        @endif
    <div class="container">
        <div class="row" style="margin-top:45px">
            <div class="col-md-12 col-md-offset-12">
                <h4>Login</h4>
                <form action="{{ route('auth.check') }}" method="post">
                    @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{Session::get("fail")}}
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="email" name="username" id="username" value ="{{ old ('username') }}">
                        <span class="text-danger">@error('username'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label  for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    </div>
                        <input class="btn btn-block btn-light" type="submit" value="Sign in"><br>
                        <a href="{{ route('auth.register')}}">Don't have an account? Sign up!</a>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection