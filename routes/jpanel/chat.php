<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jpanel\ChatController;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/chat', [ChatController::class,'index'])->name('chat.index');
    Route::post('/chat/send-message', [ChatController::class,'sendMessage'])->name('chat.send-message');
    Route::post('/chat/set-status', [ChatController::class,'setStatus'])->name('chat.set-status');

    // Route::get('/chat', [ChatController::class,'index'])->name('chat.index');
    // Route::post('/chat/send-message', [ChatController::class,'sendMessage'])->name('chat.send-message');

//     Route::get('/chat', 'ChatController@index')->name('chat.index');
// Route::post('/chat/send-message', 'ChatController@sendMessage')->name('chat.send-message');


    // Route::get('/chat',ChatController::class)->names('chat');


});