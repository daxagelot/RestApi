<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jpanel\CompanyController;
Route::group(['middleware' => ['auth']], function () {
    Route::get('/company', [CompanyController::class,'index'])->name('company');
    Route::post('/update-company', [CompanyController::class,'companyUpdate'])->name('company.update');
    Route::put('/update-image-company', [CompanyController::class,'companyImageUpdate'])->name('company.image.update');
    Route::get('/fetch-states/{id}', [CompanyController::class,'getStates'])->name('state.fetch');
    Route::get('/fetch-cities/{id}', [CompanyController::class,'getCities'])->name('city.fetch');
});