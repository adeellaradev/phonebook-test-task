<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ContactController::class, 'index'])->name('contact.index');

Route::group(['prefix' => '/contacts', 'controller' => ContactController::class], function () {
    Route::get('/create', 'create')->name('contact.create');
    Route::post('/', 'store')->name('contact.store');
    Route::get('/{contact}', 'edit')->name('contact.edit');
    Route::post('/update', 'update')->name('contact.update');
    Route::delete('/{contact}', 'destroy')->name('contact.destroy');


});
