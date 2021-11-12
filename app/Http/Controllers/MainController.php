<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    //Login And Register Views
    function login()
    {
        return view("auth.login");
    }
    function register()
    {
        return view("auth.register");
    }
    function home()
    {
        return view('user.home');
    }

    //User logins, logout and register
    function save(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'username' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12'
        ]);
        $user = new User();
        $user->name = $req->name;
        $user->username = $req->username;
        $user->password = Hash::make($req->password);
        $save = $user->save();

        if ($save) {
            return back()->with('success', 'User registered successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again later.');
        }
    }
    function check(Request $req)
    {
        $req->validate([
            'username' => 'required|email',
            'password' => 'required'
        ]);
        $userInfo = User::where('username', '=', $req->username)->first();

        if (!$userInfo) {
            return back()->with('fail', 'We do not recognize your email address.');
        } else {
            if (Hash::check($req->password, $userInfo->password)) {
                $req->session()->put('LoggedUser', $userInfo->id);
                $req->session()->put('UserType', $userInfo->isAdmin);
                $req->session()->put('username', $userInfo->username);
                if ($userInfo->isAdmin == 1) {
                    return redirect('admin/dashboard');
                } else {
                    return redirect('/');
                }
            } else {
                return back()->with('fail', 'Password incorrect.');
            }
        }
    }
    function logout(Request $req)
    {
        if ($req->session()->exists('LoggedUser')) {
            $req->session()->pull('LoggedUser');
            $req->session()->pull('UserType');
            $req->session()->pull('failAccess');
            $req->session()->pull('failAccessAdmin');
            $req->session()->pull('cart');
            $req->session()->pull('cartCount');
            return redirect('/auth/login');
        }
    }
    
    
    
}
