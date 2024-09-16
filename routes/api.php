<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'game', 'as' => 'game.', 'controller' => GameController::class], function () {
    Route::get('/', 'index')->name('all');
    Route::post('/', 'store')->name('create');
    Route::get('/{id}', 'show')->name('show');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('delete');
});
