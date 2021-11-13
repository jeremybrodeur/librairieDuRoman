<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
            'lname' => ['required', 'not_regex:/^[0-9]+$/'],
            'fname' => ['required', 'not_regex:/^[0-9]+$/'],
            'username' => 'required|email|unique:users',
            'password' => ['required', 'min:8' ,'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/']
        ]);
        $user = new User();
        $user->name = $req->fname." ".$req->lname;
        $user->username = $req->username;
        $user->password = Hash::make($req->password);
        $save = $user->save();

        if ($save) {
            Log::channel('custom')->info(" The user ".$req->username." has been created.");
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
                    Log::channel('custom')->info(" The user ".$req->session()->put('username')." logged in successfully.");
                    return redirect('/');
                }
            } else {
                Log::channel('custom')->info(" The user ".$req->session()->put('username')." entered a bad password.");
                return back()->with('fail', 'Password incorrect.');
            }
        }
    }
    function logout(Request $req)
    {
        if ($req->session()->exists('LoggedUser')) {
            Log::channel('custom')->info(" The user ".$req->session()->get('username')." logged out.");
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
