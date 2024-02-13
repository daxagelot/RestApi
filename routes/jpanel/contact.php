<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jpanel\ContactController;
Route::group(['middleware' => ['auth']], function () {
    Route::get('/contact-us/list', [ContactController::class,'index'])->name('list.contact');
    Route::post('/contact-us/delete/{id}', [ContactController::class,'deleteContact'])->name('delete.contact');
    Route::post('/contact-us/restore/{id}', [ContactController::class,'restoreContact'])->name('restore.contact');
});