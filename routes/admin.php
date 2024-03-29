<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CalenderContrller;
use App\Http\Controllers\admin\ArticleController;
use App\Http\Controllers\admin\CategorieController;
use App\Http\Controllers\admin\CommandeController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\LignePromotionController;
use App\Http\Controllers\admin\MarqueController;
use App\Http\Controllers\admin\LivreurController;
use App\Http\Controllers\admin\PromotionController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FactureController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\SliderController;
use Illuminate\Support\Facades\Route;

Route::group([ 'middleware'=>'lang'], function () {

    Route::get('admin/login', function () {
        return view('admin.login');
    });


    Route::post('admin/login' , [AdminController::class , 'login'] );
    Route::group(['prefix' => 'admin'  , 'middleware'=>'admin'], function () {


        Route::get('profile' , [AdminController::class , 'editProfile'] );
        Route::post('edit/profile' , [AdminController::class , 'editProfileNow'] );
        Route::post('edit/profile/password' , [AdminController::class , 'editPassword'] );




        //Dashboard
        Route::get('/' , [DashboardController::class , 'index']);





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

        //livreur
        Route::get('livreur' , [LivreurController::class , 'index'] );
        Route::post('add/livreur' , [LivreurController::class , 'addlivreur'] );
        Route::get('delete/livreur/{id}' , [LivreurController::class , 'remove'] );
        Route::post('edit/livreur/{id}' , [LivreurController::class , 'editlivreur'] );
        Route::get('livreur/list/dataTables' , [LivreurController::class , 'livreurData'] );


        //user
        Route::get('user' , [UserController::class , 'index'] );
        Route::post('add/user' , [UserController::class , 'addMarque'] );
        Route::get('delete/user/{id}' , [UserController::class , 'remove'] );
        Route::post('edit/user/{id}' , [UserController::class , 'editMarque'] );
        Route::get('user/list/dataTables' , [UserController::class , 'userData'] );


        //coupon
        Route::get('coupon' , [CouponController::class , 'index'] );
        Route::post('add/coupon' , [CouponController::class , 'addCoupon'] );
        Route::get('delete/coupon/{id}' , [CouponController::class , 'remove'] );
        Route::post('edit/coupon/{id}' , [CouponController::class , 'editCoupon'] );
        Route::get('coupon/list/dataTables' , [CouponController::class , 'couponData'] );



        //facturation
        Route::get('facture/{id}' , [FactureController::class , 'index'] );


        //promotion
        Route::get('promotion' , [PromotionController::class , 'index'] );
        Route::post('add/promotion' , [PromotionController::class , 'addPromotion'] );
        Route::get('delete/promotion/{id}' , [PromotionController::class , 'remove'] );
        Route::post('edit/promotion/{id}' , [PromotionController::class , 'editPromotion'] );
        Route::get('promotion/list/dataTables' , [PromotionController::class , 'PromotionData'] );


        //ligne promotion
        Route::get('ligne/promotion/{id}' , [LignePromotionController::class , 'index'] );
        Route::post('add/ligne/promotion/{id}' , [LignePromotionController::class , 'addPromotion'] );
        Route::get('delete/ligne/promotion/{id}/{ligne}' , [LignePromotionController::class , 'remove'] );
        Route::post('edit/ligne/promotion/{id}' , [LignePromotionController::class , 'editPromotion'] );
        Route::get('ligne/promotion/list/dataTables/{id}' , [LignePromotionController::class , 'PromotionData'] );

        //contact et réclamation
        Route::get('contact' , [ContactController::class , 'index'] );
        Route::get('contact/list/dataTables' , [ContactController::class , 'contactData'] );
        Route::get('contact/setting' , [ContactController::class , 'setting'] );
        Route::post('contact/setting' , [ContactController::class , 'UpdateSetting'] );
        Route::get('contact/publish/{id}' , [ContactController::class , 'publish'] );



        //commande
        Route::get('commande' , [CommandeController::class , 'index'] );
        Route::get('accpeter/commande/{id}' , [CommandeController::class , 'AccepterCommande'] );
        Route::get('refuser/commande/{id}' , [CommandeController::class , 'refuserCommande'] );
        Route::get('commande/list/dataTables' , [CommandeController::class , 'CommandeData'] );
        Route::get('get/liste/item/{id}' , [CommandeController::class , 'LigneCommandeData'] );

        //slider
        Route::get('slider' , [SliderController::class , 'index'] );
        Route::get('slider/list/dataTables' , [SliderController::class , 'SliderData'] );
        Route::get('delete/slider/{id}' , [SliderController::class , 'suppimer'] );
        Route::post('add/slider' , [SliderController::class , 'addSlider'] );
        Route::post('edit/slider/{id}' , [SliderController::class , 'editSlider'] );
        Route::get('accepter/slider/{id}' , [SliderController::class , 'AccepterRefuser'] );


        //calender
        Route::get('calender' , [CalenderContrller::class , 'index'] );


        //settings
            Route::get('settings' , [SettingController::class , 'setting'] );
            Route::post('settings' , [SettingController::class , 'UpdateSetting'] );



        Route::get('logout' , [AdminController::class , 'logout'] );
    });
});
