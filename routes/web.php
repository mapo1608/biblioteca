<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoanController;
use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','check_disable_user'])->group(function () {

    Route::get('/home', function () {
        if(Auth::user()->role != 3){
            return view('home');
        }else{
            return view('user_reader.home_reader');
        }
    });

    Route::resource('authors', AuthorController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('books/search_view',[BookController::class, 'search_view'])->name('books.search_view');
    Route::get('/books/search',[BookController::class, 'search_book'])->name('books.search');
    Route::get('/books/search_advanced',[BookController::class, 'search_advanced_book'])->name('books.search_advanced');
    Route::resource('books', BookController::class);
    Route::resource('users', UserController::class);

    /** Rotte per le copie del libro */
    Route::get(
        '/books/{id}/copies/create',
        [CopyController::class, 'create_from_book']
    )
        ->name('copies.create');
    Route::post(
        '/books/copies/store',
        [CopyController::class, 'store_copy']
    )
        ->name('copies.store');
    Route::get(
        '/books/copies/{copy_id}',
        [CopyController::class, 'show_copy']
    )
        ->name('copies.show');
    Route::delete(
        '/books/copies/{copy_id}',
        [CopyController::class, 'destroy_copy']
    )
        ->name('copies.destroy');
    Route::get(
        '/books/copies/{copy_id}/edit',
        [CopyController::class, 'edit_copy']
    )
        ->name('copies.edit');
    Route::patch(
        '/books/copies/{copy_id}/update',
        [CopyController::class, 'update_copy']
    )
        ->name('copies.update');

    Route::get('/loans/copies/{copy_id}',
        [LoanController::class, 'create_loan']
    )->name('loans.create');

    Route::post('/loans/copies/store',
        [LoanController::class, 'store_loan']
    )->name('loans.start_loan');

    Route::get('/loans',
        [LoanController::class, 'index_loan']
    )->name('loans.index');

    Route::get('/loans/{id}',
        [LoanController::class, 'show_loan']
    )->name('loans.show');

    Route::get('/loans/stop/{id}',
        [LoanController::class, 'stop_loan']
    )->name('loans.stop_loan');

    Route::get('/loans/user/my_loans',
        [LoanController::class, 'my_loans']
    )->name('loans.my_loans');

    Route::get('/extend_loan/{id}',
        [LoanController::class, 'extend_loan']
    )->name('extend_loan');

    Route::get('/loans/user/search_user',
        [LoanController::class, 'search_user']
    )->name('loans.search_user');
    
    Route::get('/loans/user/selected_user/{id}',
        [LoanController::class, 'selected_user']
    )->name('loans.selected_user');

});
