<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jpanel\ChatController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/chat', [ChatController::class,'index'])->name('chat.index');
    Route::post('/chat/send-message', [ChatController::class,'sendMessage'])->name('chat.send-message');
    Route::post('/chat/set-status', [ChatController::class,'setStatus'])->name('chat.set-status');
});
