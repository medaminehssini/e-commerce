<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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


Route::get('admin/login', function () {
    return view('admin.login');
})->name('login');


Route::post('admin/login' , [AdminController::class , 'login'] );
Route::group(['prefix' => 'admin' ,  'middleware' => ['auth']], function () {

    Route::get('/', function () {
        return view('admin.welcome');
    });

    Route::get('product' , [ProductController::class , 'index'] );
    Route::post('add/product' , [ProductController::class , 'addProduct'] );
    Route::get('delete/product/{id}' , [ProductController::class , 'remove'] );
    Route::post('edit/product/{id}' , [ProductController::class , 'editProduct'] );
    Route::get('product/list/dataTables' , [ProductController::class , 'productData'] );

    Route::get('logout' , [AdminController::class , 'logout'] );


});
