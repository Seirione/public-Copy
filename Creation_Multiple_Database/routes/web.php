<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubController;
use App\Http\Controllers\DemoController;

//route Organization -->path -->prefix -->Controller -->middleware

Route::prefix('sub_category')->group(function (){
    
    //sub_category/...
    Route::controller(SubController::class)->group(function(){
        Route::get('/home', 'home')->name('sub_home');
        Route::post('/insert', 'insert')->name('sub_home_insert');
        Route::get('/update/{id}', 'update')->name('sub_update_table');
        Route::put('/updating/{id}', 'updating')->name('sub_updating_table');
    });
});


Route::prefix('product')->group(function(){
       //product/...
    Route::controller(ProductController::class)->group(function(){
        Route::get('/product_home', 'product_home')->name('product_home');
        Route::post('/insert', 'insert_product')->name('product_insert');
    });
});



//demo/home -> goes demo.blade.php
Route::prefix('demo')->group(function (){

    //demo/demo_home
    Route::controller(DemoController::class)->group(function (){
        Route::get('/demo_home', 'demo_home')->name('demo_home');
        Route::post('/insert', 'insert')->name('demo_insert');


    
         Route::get('/downloadDatabase', 'downloadDatabase')->name('downloadDatabase');
    });
});


