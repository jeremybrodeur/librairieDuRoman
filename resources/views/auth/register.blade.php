@extends('layout.app')
@section('content')
@if(Session::has('LoggedUser'))
    <script>window.location = "/"</script>
@endif
    <div class="container">
        <div class="row" style="margin-top:45px">
            <div class="col-md-4 col-md-offset-4">
                <h4>Register</h4>
                <form id='registerForm' action="{{ route('auth.save')}}" method="post">
                    @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{Session::get('fail')}}
                    </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Last Name</label>
                        <input class="form-control" type="text" name="lname" id="lname" value="{{ old('lname')}}">
                        <span class="text-danger">@error('lname'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input class="form-control" type="text" name="fname" id="fname" value="{{ old('fname')}}">
                        <span class="text-danger">@error('fname'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="email" name="username" id="username" value="{{ old('username')}}">
                        <span class="text-danger">@error('username'){{ $message }}@enderror</span>

                    </div>
                    <div class="form-group">
                        <label  for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>

                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                    </div>
                        <input class="btn btn-block btn-light shadow" type="submit" value="Sign up"><br>
                        <a href="{{ route('auth.login')}}">Already have an accoutnt? Log in!</a>
                </form>
            </div>
        </div>
    </div>
 @endsection
