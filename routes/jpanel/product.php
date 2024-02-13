<?php

use App\Http\Controllers\Jpanel\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('product/list', [ProductController::class,'index'])->name('list.product');
    Route::post('product/status', [ProductController::class,'productStatus'])->name('status.product');
    Route::get('product/details/{id}', [ProductController::class,'productDetails'])->name('details.product');
    //Product add
    Route::get('product/add', [ProductController::class,'productAdd'])->name('add.product');
    Route::post('product/store', [ProductController::class,'productStore'])->name('store.product');
    //Product Edit
    Route::get('product/edit/{id}', [ProductController::class,'productEdit'])->name('edit.product');
    Route::post('product/update/{id}', [ProductController::class,'productUpdate'])->name('update.product');
    //Product Delete
    Route::post('product/delete/{id}', [ProductController::class,'productDelete'])->name('delete.product');
    //product attribute
    Route::get('product/attribute/{id}', [ProductController::class,'productAttribute'])->name('attribute.product');
    //attribute value on change
    Route::get('product/attribute_value', [ProductController::class,'productAttributeValue'])->name('attribute.value.product');
    //add product attribute
    Route::post('product/attribute_store', [ProductController::class,'productAttributeStore'])->name('store.attribute.product');
    //Product attribute Delete
    Route::post('product/attribute_delete/{id}', [ProductController::class,'productAttributeDelete'])->name('delete.attribute.product');
    //product uploads
    Route::get('product/uploads/{id}', [ProductController::class,'uploads'])->name('uploads.product');
    Route::post('product/upload', [ProductController::class,'storeImage'])->name('upload.image.product');
    Route::get('product/image_delete/{id}', [ProductController::class,'imageDelete'])->name('product.image.delete');
    Route::post('product/image_order', [ProductController::class,'imageOrder'])->name('order.image.product');
    
});
