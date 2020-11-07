<?php


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

use App\Http\Controllers\UserController as ControllersUserController;
use Illuminate\Support\Facades\Route;

Route::get('signup' , [ControllersUserController::class , 'register'] );
Route::post('signup' , [ControllersUserController::class , 'registerNow'] );
Route::get('login' , [ControllersUserController::class , 'login'] )->name('login');
Route::post('login' , [ControllersUserController::class , 'loginNow'] );
Route::get('/', function () {
    return view('boutique.welecome');
});


Route::group([ 'middleware'=>'auth'], function () {

    //user
    Route::get('edit/account' , [ControllersUserController::class , 'account'] );
    Route::post('edit/account' , [ControllersUserController::class , 'accountNow'] );

    Route::get('logout' , [ControllersUserController::class , 'logout'] );



});
