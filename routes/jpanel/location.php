<?php

use App\Http\Controllers\Jpanel\LocationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    // -----------------------------------COUNTRY----------------------------------------
    Route::get('/location/country', [LocationController::class,'country'])->name('list.country');
    Route::post('/location/country/store', [LocationController::class,'countryStore'])->name('store.country');
    Route::get('/location/country/edit/{id}', [LocationController::class,'countryEdit'])->name('edit.country');
    Route::post('/location/country/update/{id}', [LocationController::class,'countryUpdate'])->name('update.country');
    Route::post('/location/country/delete', [LocationController::class,'countryDelete'])->name('delete.country');
    Route::post('/location/country/restore', [LocationController::class,'countryRestore'])->name('restore.country');
    // -----------------------------------STATE----------------------------------------
    Route::get('/location/state', [LocationController::class,'state'])->name('list.state');
    Route::post('/location/state/store', [LocationController::class,'stateStore'])->name('store.state');
    Route::get('/location/state/edit/{id}', [LocationController::class,'stateEdit'])->name('edit.state');
    Route::post('/location/state/update/{id}', [LocationController::class,'stateUpdate'])->name('update.state');
    Route::post('/location/state/delete', [LocationController::class,'stateDelete'])->name('delete.state');
    Route::post('/location/state/restore', [LocationController::class,'stateRestore'])->name('restore.state');
    // ------------------------------------CITY ---------------------------------------
    Route::get('/location/city', [LocationController::class,'city'])->name('list.city');
    Route::post('/location/city/store', [LocationController::class,'cityStore'])->name('store.city');
    Route::get('/location/city/edit/{id}', [LocationController::class,'cityEdit'])->name('edit.city');
    Route::post('/location/city/update/{id}', [LocationController::class,'cityUpdate'])->name('update.city');
    Route::post('/location/city/delete', [LocationController::class,'cityDelete'])->name('delete.city');        
    Route::post('/location/city/restore', [LocationController::class,'cityRestore'])->name('restore.city');        
    // -----------------------------------AREA-----------------------------------------
    Route::get('/location/area', [LocationController::class,'area'])->name('list.area');
    Route::post('/location/area/store', [LocationController::class,'areaStore'])->name('store.area');
    Route::get('/location/area/edit/{id}', [LocationController::class,'areaEdit'])->name('edit.area');
    Route::post('/location/area/update/{id}', [LocationController::class,'areaUpdate'])->name('update.area');
    Route::post('/location/area/delete', [LocationController::class,'areaDelete'])->name('delete.area');        
    Route::post('/location/area/restore', [LocationController::class,'areaRestore'])->name('restore.area');        
});
