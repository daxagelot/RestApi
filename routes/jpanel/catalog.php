<?php

use App\Http\Controllers\Jpanel\Catalog\CategoryController;
use App\Http\Controllers\Jpanel\Catalog\GalleryController;
use App\Http\Controllers\Jpanel\Catalog\BrandController;
use App\Http\Controllers\Jpanel\Catalog\AttributeController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    // -------------------- Category ----------------------------------------------------------------------------------------------------
    Route::get('/catalog/category', [CategoryController::class,'index'])->name('list.category');
    Route::get('/catalog/category/add', [CategoryController::class,'create'])->name('create.category');
    Route::post('/catalog/category/add', [CategoryController::class,'store'])->name('store.category');
    Route::get('/catalog/category/edit/{id}', [CategoryController::class,'edit'])->name('edit.category');
    Route::put('/catalog/category/edit/{id}', [CategoryController::class,'update'])->name('update.category');
    Route::put('/catalog/category/edit/description/{id}', [CategoryController::class,'updateCategoryDescription'])->name('update.category.description');
    Route::put('/catalog/category/edit/meta/{id}', [CategoryController::class,'updateCategoryMeta'])->name('update.category.meta');
    Route::put('/catalog/category/edit/thumbnail/{id}', [CategoryController::class,'updateCategoryThumbnail'])->name('update.category.thumbnail');
    Route::put('/catalog/category/edit/icon/{id}', [CategoryController::class,'updateCategoryIcon'])->name('update.category.icon');
    Route::put('/catalog/category/edit/cover/{id}', [CategoryController::class,'updateCategoryCover'])->name('update.category.cover');
    Route::post('/catalog/category/status', [CategoryController::class,'statusUpdate'])->name('status.change.category');
    Route::post('/catalog/category/menu/status', [CategoryController::class,'menuStatusUpdate'])->name('menu.status.category');
    Route::post('/catalog/category/delete', [CategoryController::class,'destroy'])->name('category.delete');

    //--------------------- Brand -----------------------------------------------------------------------------------------------
    Route::get('/catalog/brands', [BrandController::class,'index'])->name('list.brands');
    Route::get('/catalog/brand/add', [BrandController::class,'create'])->name('create.brand');
    Route::post('/catalog/brand/add', [BrandController::class,'store'])->name('store.brand');
    Route::get('/catalog/brand/edit/{id}', [BrandController::class,'edit'])->name('edit.brand');
    Route::put('/catalog/brand/edit/{id}', [BrandController::class,'update'])->name('update.brand');
    Route::put('/catalog/brand/edit/description/{id}', [BrandController::class,'updateBrandDescription'])->name('update.brand.description');
    Route::put('/catalog/brand/edit/meta/{id}', [BrandController::class,'updateBrandMeta'])->name('update.brand.meta');
    Route::put('/catalog/brand/edit/icon/{id}', [BrandController::class,'updateBrandLogo'])->name('update.brand.logo');
    Route::put('/catalog/brand/edit/cover/{id}', [BrandController::class,'updateBrandCover'])->name('update.brand.cover');
    Route::post('/catalog/brand/status', [BrandController::class,'statusUpdate'])->name('status.change.brand');
    Route::post('/catalog/brand/delete', [BrandController::class,'destroy'])->name('brand.delete');

    //--------------------- Attribute -----------------------------------------------------------------------------------------------
    Route::get('/catalog/attribute', [AttributeController::class,'index'])->name('list.attributes');
    Route::get('/catalog/attribute/add', [AttributeController::class,'create'])->name('create.attribute');
    Route::post('/catalog/attribute/add', [AttributeController::class,'store'])->name('store.attribute');
    Route::get('/catalog/attribute/edit/{id}', [AttributeController::class,'edit'])->name('edit.attribute');
    Route::put('/catalog/attribute/edit/{id}', [AttributeController::class,'update'])->name('update.attribute');
    Route::post('/catalog/attribute/status', [AttributeController::class,'statusUpdate'])->name('status.change.attribute');
    Route::post('/catalog/attribute/delete', [AttributeController::class,'destroy'])->name('attribute.delete');
    Route::get('/catalog/attribute/value/{id}', [AttributeController::class,'value'])->name('value.attribute');
    Route::post('/catalog/attribute/value/{id}', [AttributeController::class,'valueAdd'])->name('store.value.attribute');
    Route::post('/catalog/attribute/value-delete', [AttributeController::class,'valueDelete'])->name('attribute.value.delete');


//----------------------------Gallery---------------------------------//

Route::get('/catalog/gallery', [GalleryController::class,'index'])->name('list.gallery');
Route::get('/catalog/gallery/add', [GalleryController::class,'create'])->name('create.gallery');
Route::post('/catalog/gallery/add', [GalleryController::class,'store'])->name('store.gallery');
Route::get('/catalog/gallery/edit/{id}', [GalleryController::class,'edit'])->name('edit.gallery');
Route::put('/catalog/gallery/edit/{id}', [GalleryController::class,'update'])->name('update.gallery');
Route::put('/catalog/gallery/edit/thumbnail/{id}', [GalleryController::class,'updateGalleryThumbnail'])->name('update.gallery.thumbnail');
Route::put('/catalog/gallery/edit/icon/{id}', [GalleryController::class,'updateGalleryIcon'])->name('update.gallery.icon');
Route::put('/catalog/gallery/edit/cover/{id}', [GalleryController::class,'updateGalleryCover'])->name('update.gallery.cover');
Route::post('/catalog/gallery/status', [GalleryController::class,'statusUpdate'])->name('status.change.gallery');
Route::post('/catalog/gallery/delete', [GalleryController::class,'destroy'])->name('gallery.delete');
Route::get('/catalog/gallery/edit/{gallery}', [GalleryController::class,'edit'])->name('edit.gallery');
Route::put('/catalog/gallery/edit/{gallery}', [GalleryController::class, 'update'])->name('update.gallery');
Route::get('/catalog/gallery/edit/{gallery}', [GalleryController::class, 'edit'])->name('edit.gallery');
Route::put('/catalog/gallery/edit/{gallery}', [GalleryController::class, 'update'])->name('update.gallery');
// Add other routes as needed
});
