<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShoppingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.home');
});
//MainRoutes
Route::get('/auth/login', [MainController::class, "login"])->name('auth.login');
Route::get('/auth/register', [MainController::class, "register"])->name('auth.register');
Route::post('/auth/save', [MainController::class, "save"])->name('auth.save');
Route::post('/auth/check', [MainController::class, "check"])->name('auth.check');
Route::get('/auth/logout', [MainController::class, "logout"])->name('auth.logout');
//AdminRoutes
Route::get('/admin/dashboard', [AdminController::class, "dashboard"])->name('admin.dashboard');
Route::get('/admin/manageUser', [AdminController::class, "manageUser"])->name('admin.manageUser');
Route::get('/admin/manageUser/{id}', [AdminController::class, "manageUserSelect"])->name('admin.details');
Route::post('/admin/update/{id}', [AdminController::class, "updateUser"])->name('admin.update');
Route::get('/admin/deleteUser/{id}', [AdminController::class, "deleteUser"]);
Route::post('/admin/createUser', [AdminController::class, "createUser"]);
Route::get('/admin/createView', [AdminController::class, "createUserView"])->name('admin.create');
//BookRoutes
Route::get('/admin/manageBooks', [AdminController::class, "manageBooks"])->name('admin.manageBooks');
Route::get('/admin/manageBook/{isbn}', [AdminController::class, "manageBookSelect"]);
Route::get('/admin/deleteBook/{isbn}', [AdminController::class, "deleteBook"]);
Route::post('/admin/updateBook/{isbn}', [AdminController::class, "updateBook"]);
Route::get('/admin/createBookGet', [AdminController::class, "createBookGet"])->name('admin.createBookGet');
Route::post('/admin/createBookPost', [AdminController::class, "createBookPost"])->name('admin.createBookPost');
//Shopping
Route::get('/shopping/cart', [ShoppingController::class, "getCart"])->name('user.cart');
Route::get('/shopping/add/{isbn}', [ShoppingController::class, "addCart"])->name('user.addCart');
Route::get('/shopping/books', [ShoppingController::class, "getBooks"])->name('user.books');
Route::get('/shopping/checkout', [ShoppingController::class, "checkout"]);
Route::get('/shopping/emptyCart', [ShoppingController::class, "emptyCart"]);
Route::get('/shopping/delete/{isbn}', [ShoppingController::class, "deleteItem"]);
Route::post('/shopping/facture', [ShoppingController::class, "createFacture"]);
