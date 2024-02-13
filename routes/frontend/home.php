<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', [HomeController::class,'index'])->name('home.index');

//contact us section
// Route::get('/index', [HomeController::class,'index'])->name('index');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog_detail', [HomeController::class, 'blog_detail'])->name('blog_detail');


Route::post('/contact-us-store', [HomeController::class,'storeContactUs'])->name('store.contactus');
Route::get('/gallery', [HomeController::class, 'showGallery'])->name('gallery.show');
