<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Facture;
use App\Models\User;

class ShoppingController extends Controller
{
    //Shopping
    function getBooks()
    {
        $allBook = Book::all();
        return view('user.books')->with('allBook', $allBook);
    }
    function addCart($isbn, Request $req)
    {
        $req->session()->pull('bookAdded');
        $book = Book::find($isbn);
        if (!$book) {
            abort(404);
        }
        $cart = $req->session()->get('cart');
        if (!$cart) {

            $cart = [
                $isbn => [
                    'titre' => $book->titre,
                    'auteur' => $book->auteur,
                    'prix' => $book->prix,
                    'quantite' => $book->quantite,
                    'quantityInCart' => 1,
                    'photo' => $book->photo,
                    'resume' => $book->resume
                ]
            ];
            $req->session()->put('cart', $cart);
            $count = 0;
            foreach ($cart as $isbn => $details) {
                $count += $details['quantityInCart'];
            }
            $cartCount = $count;
            $req->session()->put('cartCount', $cartCount);
            return back()->with('bookAdded', 'Book has been added to your cart!');
        }
        if (isset($cart[$isbn])) {
            $cart[$isbn]['quantityInCart']++;
            session()->put('cart', $cart);
            $count = 0;
            foreach ($cart as $isbn => $details) {
                $count += $details['quantityInCart'];
            }
            $cartCount = $count;
            $req->session()->put('cartCount', $cartCount);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        $cart[$isbn] = [
            'titre' => $book->titre,
            'auteur' => $book->auteur,
            'prix' => $book->prix,
            'quantite' => $book->quantite,
            'quantityInCart' => 1,
            'photo' => $book->photo,
            'resume' => $book->resume
        ];
        session()->put('cart', $cart);
        $count = 0;
        foreach ($cart as $isbn => $details) {
            $count += $details['quantityInCart'];
        }
        $cartCount = $count;
        $req->session()->put('cartCount', $cartCount);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    function getCart()
    {
        return view('user.cart');
    }

    function emptyCart(Request $req)
    {
        if ($req->session()->get('cartCount') > 0) {
            $req->session()->pull('cart');
            $req->session()->pull('cartCount');
            return back();
        } else {
            return redirect()->back()->with('cartIsEmpty', 'Votre panier est déjà vide.');
        }
    }
    function deleteItem($isbn)
    {

        $cart = session()->get('cart');
        if ($cart[$isbn]['quantityInCart'] == 1) {
            unset($cart[$isbn]);
            session()->put('cart', $cart);
            $count = 0;
            foreach ($cart as $isbn => $details) {
                $count += $details['quantityInCart'];
            }
            $cartCount = $count;
            session()->put('cartCount', $cartCount);
            return redirect()->back();
        } else {
            $cart[$isbn]['quantityInCart']--;
            session()->put('cart', $cart);
            $count = 0;
            foreach ($cart as $isbn => $details) {
                $count += $details['quantityInCart'];
            }
            $cartCount = $count;
            session()->put('cartCount', $cartCount);
            return redirect()->back();
        }
    }
    function checkout(Request $req)
    {
        if ($req->session()->exists('LoggedUser')) {

            return view('user.checkout');
        } else {
            return redirect()->back()->with('logToCheckout', 'You have to be logged in to checkout.');
        }
    }
    function createFacture(Request $req)
    {
        $req->validate([
            'pickUpDate' => 'required',
            'region' => 'required'
        ]);
        $facture = new Facture();
        $facture->pickUpDate = $req->pickUpDate;
        $facture->region = $req->region;
        $facture->total = $req->session()->get('total');
        $facture->user_id = $req->session()->get('LoggedUser');
        $save = $facture->save();
        $books = $req->session()->get('cart');
        if ($books) {
            $quantityAfterPurchase = 0;
            foreach ($books as $isbn => $book) {
                $quantityAfterPurchase = $book['quantite'] - $book['quantityInCart'];
                $save = Book::where('isbn', $isbn)->update(array('quantite' => $quantityAfterPurchase));
            }
        }
        $user = User::find($facture->user_id);
        switch ($facture->region) {
            case "Québec":
                $taxe = 0.14975;
                break;
            case "Ontario":
                $taxe = 0.13;
                break;
            case "Colombie-Britannique":
                $taxe = 0.12;
                break;
            case "Alberta":
                $taxe = 0.05;
                break;
            case "Île-du-Prince-Édouard":
                $taxe = 0.15;
                break;
            case "Manitoba":
                $taxe = 0.12;
                break;
            case "Nouvelle-Écosse":
                $taxe = 0.15;
                break;
            case "Saskatchewan":
                $taxe = 0.11;
                break;
            case "Terre-Neuve-et-Labrador":
                $taxe = 0.15;
                break;
            case "Nouveau-Brunswick":
                $taxe = 0.15;
                break;
        }
        if ($save) {
            $req->session()->pull('cart');
            $req->session()->pull('cartCount');
            return view('user.final')->with('facture', $facture)->with('user', $user)->with('taxe', $taxe);
        } else {
            return back()->with('failCheckout', 'Something went wrong, try again later.');
        }
    }
}
