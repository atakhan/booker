<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

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
    return view('welcome', ['data' => WebController::getBooks()]);
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard', ['data' => 
        [
            'books' => WebController::getBooks(),
            'authors' => WebController::getAuthors()
        ]
    ]);
})->name('dashboard');

