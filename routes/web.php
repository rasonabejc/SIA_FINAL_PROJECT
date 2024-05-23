<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UsersController;

use Illuminate\Support\Facades\Route;

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

Route::get('/', [SiteController::class, 'home']);


Route::get('users', [UsersController::class, 'index']);
Route::get('users/create', [UsersController::class, 'create']);
Route::post('users', [UsersController::class, 'store']);
Route::get('users/{user}/edit', [UsersController::class, 'edit']);
Route::put('users/{user}', [UsersController::class, 'update']);
Route::get('users/pdf', [UsersController::class, 'pdf']); // Updated method name



Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');


Route::get('/books', [BookController::class, 'index'])->name('books.index');



Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');


Route::get('users/pdf', [UsersController::class, 'pdf']);

Route::get('/users/export/csv', [UsersController::class, 'generateCSV'])->name('users.export.csv');
Route::get('/users/scan', [UsersController::class, 'scan']);

Route::get('/users/import', [UsersController::class, 'showImportForm'])->name('users.import');
Route::post('/users/import', [UsersController::class, 'importCSV'])->name('users.import.post');