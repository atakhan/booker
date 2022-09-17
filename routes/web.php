<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

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
    return view('welcome', ['data' => AuthorController::getAll()]);
});

Route::get('/dashboard', function () {
    return view('dashboard', ['data' => AuthorController::getAll()]);
});

Route::get('/dashboard/author/create', function () {
    return view('dashboard', ['data' => AuthorController::getAll()]);
})->name('createAuthor');

