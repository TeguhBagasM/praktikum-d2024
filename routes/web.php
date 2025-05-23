<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\BookController;
use App\Models\Book;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/notes', NoteController::class);

Route::resource('/mahasiswa', MahasiswaController::class);

Route::resource('/books', BookController::class);

// Route::get('/truncate', function () {
//     Mahasiswa::truncate();
// });
