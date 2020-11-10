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

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\UserController as ControllersUserController;
use App\Http\Controllers\WishListController;
use Gloudemans\Shoppingcart\Facades\Cart;
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
    Route::post('edit/adresse' , [ControllersUserController::class , 'adresse'] );
    Route::get('logout' , [ControllersUserController::class , 'logout'] );

    //add commentaire
    Route::post('product/detail/{id}' , [CommentaireController::class , 'addCommentaire'] );
    //wishlist
    Route::get('wish/add/{id}', [WishListController::class , 'add']);
    Route::get('wish/remove/{id}', [WishListController::class , 'remove']);
    Route::get('wish', [WishListController::class , 'index']);
    //commande
    Route::post('add/commande' , [CommandeController::class , 'ajouterCommande'] );

    //panier
    Route::post('panier/recalculer' , [PanierController::class , 'recalculer'] );
    Route::get('panier', [PanierController::class , 'index'] );

});


  //product
  Route::get('product/detail/{id}' , [ProductController::class , 'getArticle'] )->name('product.index');
  Route::get('quick/product/detail/{id}' , [ProductController::class , 'getQuikArticle'] );

  //search
  Route::get('search', [SearchController::class , 'index']);




  //compare
    Route::get('compare' , [CompareController::class , 'index'] );
    Route::get('compare/add/{id}' , [CompareController::class , 'addItem'] );
    Route::get('compare/remove/{id}' , [CompareController::class , 'RemoveItem'] );

  //compare
    Route::get('contact' , [ContactController::class , 'index'] );
    Route::post('contact' , [ContactController::class , 'store'] );

  //Panier
  Route::get('panier/add/{id}', [PanierController::class , 'addPanier'] );
  Route::get('panier/vider', [PanierController::class , function ()
  {
      Cart::destroy();
      alert()->success('Panier bien vidé.', '')->toToast();
      return back();
  }] );

  Route::get('panier/remove/{id}', [PanierController::class , 'removePanier'] );










