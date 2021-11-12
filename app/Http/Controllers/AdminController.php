<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{//Admin
    function dashboard()
    {
        $users = count(User::all());
        $books = count(Book::all());

        return view('admin.dashboard')->with('userTable', $users)->with('bookTable', $books);
    }

    function manageUser()
    {
        $allUser = User::all();
        return view('admin.userManagement')->with('allUser', $allUser);
    }
    function manageUserSelect($id)
    {
        $user = User::where('id', '=', $id)->first();
        return view('admin.userDetail')->with('user', $user);
    }
    function updateUser(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'username' => 'required|email|unique:users',
            'isAdmin' => 'required'
        ]);
        $user = User::where('id', '=', $req->id)->first();
        $user->name = $req->name;
        $user->username = $req->username;
        if ($req->isAdmin == 1) {
            $user->isAdmin = true;
        } else {
            $user->isAdmin = false;
        }
        $save = $user->save();
        if ($save) {
            return back()->with('success', 'User updated successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again later.');
        }
        return view('admin.userManagement');
    }
    function createUserView()
    {
        return view('admin.userCreate');
    }
    function createUser(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'username' => 'required|email|unique:users',
            'isAdmin' => 'required',
            'password' => 'required|min:5|max:12'
        ]);
        $user = new User();
        $user->name = $req->name;
        $user->username = $req->username;
        if ($req->isAdmin == 1) {
            $user->isAdmin = true;
        } else {
            $user->isAdmin = false;
        }
        $user->password = Hash::make($req->password);
        $save = $user->save();

        if ($save) {
            return back()->with('success', 'User registered successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again later.');
        }
    }
    function deleteUser($id)
    {
        $deletedRows = User::where('id', $id)->delete();
        if ($deletedRows) {
            return redirect('/admin/manageUser');
        } else {
            return back()->with('fail', 'Something went wrong, try again later.');
        }
    }
    //Books
    function createBookGet()
    {
        return view('admin.bookCreate');
    }
    function manageBookSelect($isbn)
    {
        $book = Book::where('isbn', '=', $isbn)->first();
        return view('admin.bookDetail')->with('book', $book);
    }
    function updateBook(Request $req)
    {
        $req->validate([
            'auteur' => 'required',
            'titre' => 'required|max:50',
            'prix' => 'required|numeric',
            'quantite' => 'required|numeric',
            'photo' => 'required',
            'resume' => 'required'
        ]);
        $save = Book::where('isbn', $req->isbn)
            ->update(['auteur' => $req->auteur, 'titre' => $req->titre, 'prix' => $req->prix, 'quantite' => $req->quantite, 'photo' => $req->photo, 'resume' => $req->resume]);
        if ($save) {
            return back()->with('success', 'Book updated successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again later.');
        }
        return view('admin.userManagement');
    }
    function createBookPost(Request $req)
    {
        $req->validate([
            'isbn' => 'required|unique:books|numeric',
            'auteur' => 'required',
            'titre' => 'required|max:50',
            'prix' => 'required|numeric',
            'quantite' => 'required|numeric',
            'photo' => 'required',
            'resume' => 'required'
        ]);
        $book = new Book();
        $book->isbn = $req->isbn;
        $book->auteur = $req->auteur;
        $book->titre = $req->titre;
        $book->prix = $req->prix;
        $book->quantite = $req->quantite;
        $book->photo = $req->photo;
        $book->resume = $req->resume;
        $save = $book->save();
        if ($save) {
            return back()->with('success', 'Book registered successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again later.');
        }
    }
    function manageBooks()
    {
        $allBook = Book::all();
        return view('admin.bookManagement')->with('allBook', $allBook);
    }
    function deleteBook($isbn)
    {
        $deletedRows = Book::where('isbn', $isbn)->delete();
        if ($deletedRows) {
            return redirect('/admin/manageBooks');
        } else {
            return back()->with('fail', 'Something went wrong, try again later.');
        }
    }
}
