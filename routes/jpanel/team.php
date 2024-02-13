<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jpanel\TeamController;

Route::group(['middleware' => ['auth']], function () {
    Route::resource('team',TeamController::class)->names('team');


});