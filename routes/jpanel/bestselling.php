<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jpanel\BestSellingController;
Route::group(['middleware' => ['auth']], function () {

    // -------------------- bestSelling --------------------------------------------------
    Route::get('/bestSelling/list', [BestSellingController::class,'index'])->name('list.bestSelling');
    Route::post('/bestSelling/store', [BestSellingController::class,'bestSellingStore'])->name('store.bestSelling');
    Route::get('/bestSelling/edit/{id}', [BestSellingController::class,'bestSellingEdit'])->name('edit.bestSelling');
    Route::post('/bestSelling/update/{id}', [BestSellingController::class,'bestSellingUpdate'])->name('update.bestSelling');
    Route::post('/bestSelling/status', [BestSellingController::class,'bestSellingStatus'])->name('status.bestSelling');
    Route::post('/bestSelling/delete/{id}', [BestSellingController::class,'bestSellingDelete'])->name('delete.bestSelling');
    Route::post('/bestSelling/restore/{id}', [BestSellingController::class,'bestSellingRestore'])->name('restore.bestSelling');
});