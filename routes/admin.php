<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\DashboardController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::get('/admin-login',[LoginController::class,'adminLogin'])->name('admin.login');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');


    Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware'=>'is_admin'],function(){
    Route::get('/admin/home','AdminController@admin')->name('admin.home');
    Route::get('/admin/logout','AdminController@logout')->name('admin.logout');


    //category routes
    Route::group(['prefix'=>'category'],function(){
        Route::get('/','CategoryController@index')->name('category.index');
        Route::post('/category','CategoryController@store')->name('category.store');
        Route::get('/delete/{id}','CategoryController@destroy')->name('category.delete');
        Route::get('/edit/{id}','CategoryController@edit');
        Route::post('/update','CategoryController@update')->name('category.update');


    });

        //Subcategory routes
        Route::group(['prefix'=>'subcategory'],function(){
            Route::get('/','SubcategoryController@index')->name('subcategory.index');
            Route::post('/store','SubcategoryController@store')->name('subcategory.store');
            Route::get('/delete/{id}','SubcategoryController@destroy')->name('subcategory.delete');
            Route::get('/edit/{id}','SubcategoryController@edit');
            Route::post('/update','SubcategoryController@update')->name('subcategory.update');
        });

        //Childcategory routes
        Route::group(['prefix'=>'childcategory'],function(){
            Route::get('/','ChildcategoryController@index')->name('childcategory.index');
            Route::post('/store','ChildcategoryController@store')->name('childcategory.store');
            Route::get('/delete/{id}','ChildcategoryController@destroy')->name('childcategory.delete');
            Route::get('/edit/{id}','ChildcategoryController@edit');
            Route::post('/update','ChildcategoryController@update')->name('childcategory.update');


        });
        //Brand Route
        Route::group(['prefix'=>'brand'],function(){
            Route::get('/','BrandController@index')->name('brand.index');
            Route::post('/store','BrandController@store')->name('brand.store');
            Route::get('/delete/{id}','BrandController@destroy')->name('brand.delete');
            Route::get('/edit/{id}','BrandController@edit');
            Route::post('/update','BrandController@update')->name('brand.update');

        });
    });
