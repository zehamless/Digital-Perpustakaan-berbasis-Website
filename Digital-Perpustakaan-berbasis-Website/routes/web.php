<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('/books');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('books', BookController::class)->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::prefix('books/mybooks')->group(function () {
        Route::get('/', [BookController::class, 'userIndex'])->name('books.userIndex');
        Route::get('/export', [BookController::class, 'exportPdf'])->name('books.export');
    });
});
Route::resource('categories', CategoryController::class)->middleware('auth');

require __DIR__ . '/auth.php';
