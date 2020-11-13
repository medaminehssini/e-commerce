<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commande;
use App\Models\Coupon;
use App\Models\LigneCommande;
use App\Models\Livreur;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function ajouterCommande()
    {

        $id_livreur = null;
        if(request()->ville) {
            if( request()->livreur != ''  ) {
                if(request()->ville == "grand_tunis" && request()->livreur == 0 ) {
                    $id_livreur = 0 ;
                }else {
                    $livreur = Livreur::find(request()->livreur);
                    if($livreur){
                        $id_livreur  = request()->livreur;
                    }else {
                        alert()->error('verifier livreur.', '')->toToast();
                        return back();
                    }
                }
            }else {
                alert()->error('please select livreur.', '')->toToast();
                return back();
            }
        }else {
            alert()->error('please select city.', '')->toToast();
            return back();
        }

        $com = new Commande();

        if(request()->adresse){
            if(request()->adresse == "olddresse") {
                if(!Auth::user()->adresse && !Auth::user()->ville) {
                    alert()->error('votre adresse de compte est vide.', '')->toToast();
                    return back();
                }
            }else {
                if (request()->nadresseliv && request()->nville) {
                    $com->adresseliv = request()->nadresseliv ;
                    $com->villeliv =  request()->nville ;
                }else{
                    alert()->error('l\'adresse de livraison est vide.', '')->toToast();
                    return back();
                }

            }
        }



        if(request()->coupon){
            $coup = Coupon::where(['code'=>request()->coupon , ['qty' ,'>' , '0'] ])->orWhere(['code'=>request()->coupon  , ['date_fin' ,'<' , Carbon::now()] ])->first();
            if( $coup) {
                $com->id_coupon =  $coup->id ;
            }else {
                alert()->error('Coupon non valide.', '')->toToast();
                return back();
            }


        }


        $com->id_client = Auth::user()->id;
        $com->description = "";
        $com->id_livreur = $id_livreur;
        $com->total = Cart::total();
        $com->save();

        $articles = [] ;
        foreach (Cart::content() as $key => $art) {
            $articles[$art->id] = ['qty' => $art->qty] ;
        }
        $com->article()->attach( $articles);

        alert()->success('Commande bien passé.', '')->toToast();
        Cart::destroy();
        return view('boutique.commande.success');
    }
}
