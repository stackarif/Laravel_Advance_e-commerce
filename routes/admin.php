<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login',[LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('login',[LoginController::class,'login'])->name('admin.login.post');
    Route::get('logout', [LoginController::class,'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

        //Setting
        Route::get('/settings', [SettingController::class,'index'])->name('admin.settings');
        Route::post('/settings', [SettingController::class,'update'])->name('admin.settings.update');

        //Categories
        Route::group(['prefix'  =>   'categories'], function() {

            Route::get('/', [CategoryController::class,'index'])->name('admin.categories.index');
            Route::get('/create', [CategoryController::class,'create'])->name('admin.categories.create');
            Route::post('/store', [CategoryController::class,'store'])->name('admin.categories.store');
            Route::get('/{id}/edit', [CategoryController::class,'edit'])->name('admin.categories.edit');
            Route::post('/update', [CategoryController::class,'update'])->name('admin.categories.update');
            Route::get('/{id}/delete', [CategoryController::class,'delete'])->name('admin.categories.delete');
        
        });

        //Attribuste
        Route::group(['prefix'  =>   'attributes'], function() {

            Route::get('/', [AttributeController::class,'index'])->name('admin.attributes.index');
            Route::get('/create', [AttributeController::class,'create'])->name('admin.attributes.create');
            Route::post('/store', [AttributeController::class,'store'])->name('admin.attributes.store');
            Route::get('/{id}/edit', [AttributeController::class,'edit'])->name('admin.attributes.edit');
            Route::post('/update', [AttributeController::class,'update'])->name('admin.attributes.update');
            Route::get('/{id}/delete', [AttributeController::class,'delete'])->name('admin.attributes.delete');
        
        });
        //Attribute value
        Route::post('/get-values', [AttributeValueController::class,'getValues']);
        Route::post('/add-values', [AttributeValueController::class,'addValues']);
        Route::post('/update-values', [AttributeValueController::class,'updateValues']);
        Route::post('/delete-values', [AttributeValueController::class,'deleteValues']);
    
    });




});
