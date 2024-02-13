<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jpanel\ReviewController;
Route::group(['middleware' => ['auth']], function () {

    // -------------------- review --------------------------------------------------
    Route::get('/review/list', [ReviewController::class,'index'])->name('list.review');
    Route::get('/review/create', [ReviewController::class,'reviewCreate'])->name('create.review');
    Route::post('/review/store', [ReviewController::class,'reviewStore'])->name('store.review');
    Route::get('/review/edit/{id}', [ReviewController::class,'reviewEdit'])->name('edit.review');
    Route::post('/review/update/{id}', [ReviewController::class,'reviewUpdate'])->name('update.review');
    Route::post('/review/status', [ReviewController::class,'reviewStatus'])->name('status.review');
    Route::post('/review/delete/{id}', [ReviewController::class,'reviewDelete'])->name('delete.review');
    Route::post('/review/restore/{id}', [ReviewController::class,'reviewRestore'])->name('restore.review');
});