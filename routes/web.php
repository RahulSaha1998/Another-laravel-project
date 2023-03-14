<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthcontroller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\User;


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
    return view('welcome');
});

//Login & registration
Route::get('/login',[CustomAuthcontroller::class,'login']);//->middleware('isLoggedIn');
Route::get('/registration',[CustomAuthcontroller::class,'registration']);//->middleware('alreadyLoggedIn');
Route::post('/regis-user',[CustomAuthcontroller::class,'registerUser'])->name('register-user');
Route::post('/login-user',[CustomAuthcontroller::class,'loginUser'])->name('login-user');
Route::get('/logout',[CustomAuthcontroller::class,'logout']);

    

//profile
Route::get('profile', [ProfileController::class, 'profile'])->middleware('isLoggedIn');
Route::get('edit-profile/{id}', [ProfileController::class, 'editprofile'])->middleware('isLoggedIn');
Route::put('update-profile/{id}', [ProfileController::class, 'update'])->middleware('isLoggedIn');


//products
Route::get('products', [ProductController::class, 'index'])->middleware('isLoggedIn');
Route::get('add-product', [ProductController::class, 'create'])->middleware('isLoggedIn');
Route::post('add-product', [ProductController::class, 'store'])->middleware('isLoggedIn');
Route::get('edit-product/{id}', [ProductController::class, 'edit'])->middleware('isLoggedIn');
Route::put('update-product/{id}', [ProductController::class, 'update'])->middleware('isLoggedIn');
Route::get('delete-product/{id}', [ProductController::class, 'destroy'])->middleware('isLoggedIn');


//search
Route::get('search', [ProductController::class, 'search'])->middleware('isLoggedIn');
