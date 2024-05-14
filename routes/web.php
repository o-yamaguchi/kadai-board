<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FavoritesController;


Route::get('/', [BoardsController::class, 'index']);
Route::get('/dashboard', [BoardsController::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    
    Route::prefix('users/{id}')->group(function () {
        // Route::get('favorites', [UsersController::class, 'favorites'])->name('users.favorites');
    });
    
    Route::prefix('boards/{id}')->group(function() {
        Route::post('favorites', [FavoritesController::class, 'store'])->name('favorites.favorite');
        Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('favorites.unfavorite');
        
        Route::get('favorites', [UsersController::class, 'favorites'])->name('boards.favorites');
        Route::get('boards', [BoardsController::class, 'index'])->name('boards.boards');
    });
    
    Route::resource('boards', BoardsController::class, ['only' => ['store', 'destroy']]);
});

require __DIR__.'/auth.php';