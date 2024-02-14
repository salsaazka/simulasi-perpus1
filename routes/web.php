<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\isLogin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingPage.welcome');
});
Route::middleware([isLogin::class])->name('dashboard.')->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/create-officer', [AuthController::class, 'officer'])->name('officer');
    Route::post('/create-officer', [AuthController::class, 'createOfficer'])->name('createOfficer');
});
Route::get('/book', function () {
    return view('book.index');
})->name('');



Route::middleware('isGuest')->group(function () {
    Route::get('/sign-in', [AuthController::class, 'signIn'])->name('signIn');
    Route::post('/sign-in', [AuthController::class, 'auth'])->name('auth.login');
    Route::get('/sign-up', [AuthController::class, 'signUp'])->name('signUp');
    Route::post('/sign-up', [AuthController::class, 'register'])->name('register');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('isLogin')->prefix('/book')->name('book.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/create-book', [BookController::class, 'create'])->name('create');
    Route::post('/create-book', [BookController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [BookController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [BookController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [BookController::class, 'destroy'])->name('destroy');
});

Route::middleware('isLogin')->prefix('/borrow')->name('borrow.')->group(function () {
    Route::get('/', [BorrowController::class, 'index'])->name('index');
    Route::get('/create-borrow', [BorrowController::class, 'create'])->name('create');
    Route::post('/create-borrow', [BorrowController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [BorrowController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [BorrowController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [BorrowController::class, 'destroy'])->name('destroy');
});

Route::middleware('isLogin')->prefix('/category')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create-category', [CategoryController::class, 'create'])->name('create');
    Route::post('/create-category', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::middleware('isLogin')->prefix('/review')->name('review.')->group(function () {
    Route::get('/', [ReviewController::class, 'index'])->name('index');
    Route::get('/create-review', [ReviewController::class, 'create'])->name('create');
    Route::post('/create-review', [ReviewController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ReviewController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [ReviewController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ReviewController::class, 'destroy'])->name('destroy');
});

