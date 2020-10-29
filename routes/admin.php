<?php



use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MarqueController;
use Illuminate\Support\Facades\Route;



Route::get('admin/login', function () {
    return view('admin.login');
})->name('login');


Route::post('admin/login' , [AdminController::class , 'login'] );
Route::group(['prefix' => 'admin'  , 'middleware'=>'admin'], function () {

    Route::get('/', function () {
        return view('admin.welcome');
    });

    //articles
    Route::get('article' , [ArticleController::class , 'index'] );
    Route::post('add/article' , [ArticleController::class , 'addArticle'] );
    Route::get('delete/article/{id}' , [ArticleController::class , 'remove'] );
    Route::post('edit/article/{id}' , [ArticleController::class , 'editArticle'] );
    Route::get('article/list/dataTables' , [ArticleController::class , 'ArticleData'] );



    //categorie
    Route::get('categorie' , [CategorieController::class , 'index'] );
    Route::post('add/categorie' , [CategorieController::class , 'addCategorie'] );
    Route::get('delete/categorie/{id}' , [CategorieController::class , 'remove'] );
    Route::post('edit/categorie/{id}' , [CategorieController::class , 'editCategorie'] );
    Route::get('categorie/list/dataTables' , [CategorieController::class , 'categorieData'] );
    //marque
    Route::get('marque' , [MarqueController::class , 'index'] );
    Route::post('add/marque' , [MarqueController::class , 'addMarque'] );
    Route::get('delete/marque/{id}' , [MarqueController::class , 'remove'] );
    Route::post('edit/marque/{id}' , [MarqueController::class , 'editMarque'] );
    Route::get('marque/list/dataTables' , [MarqueController::class , 'marqueData'] );


    Route::get('logout' , [AdminController::class , 'logout'] );


});
