<?php

namespace App\Http\Controllers;

use App\Mail\OrederCompleted;
use App\Models\Commande;
use App\Models\Coupon;
use App\Models\Livreur;
use App\Models\User;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    public function ajouterCommande()
    {

        if(!Auth::user()->first_name  || !Auth::user()->last_name || !Auth::user()->tel) {
            alert()->error('Vous devez compléter votre profil', '')->toToast();
            return redirect("edit/account?type=accountDetail");
        }
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
                alert()->error('Aucun livreur sélectionné .', '')->toToast();
                return back();
            }
        }else {
            alert()->error('Vous devez remplir ville de livraison.', '')->toToast();
            return back();
        }

        $com = new Commande();

        if(request()->adresse){
            if(request()->adresse == "olddresse") {

            }else {
                if (request()->nadresseliv && request()->nville) {
                    if(!Auth::user()->adresse || !Auth::user()->ville) {
                        $user = User::find(Auth::user()->id);
                        $user->adresse = request()->nadresseliv ;
                        $user->ville = request()->nville ;
                        $user->save();
                    }else {
                        $com->adresseliv = request()->nadresseliv ;
                        $com->villeliv =  request()->nville ;
                    }

                }else{
                    alert()->error('Vous devez remplir l\'adresse de livraison.', '')->toToast();
                    return back();
                }

            }
        }

        if (request()->adressefact && request()->villefact) {
                $com->adressefact = request()->adressefact ;
                $com->villefact =  request()->villefact ;
        }

        $SetCoupon = 0;
        if(request()->coupon){
            $coup = Coupon::where(['code'=>request()->coupon , ['qty' ,'>' , '0'] ])->orWhere(['code'=>request()->coupon  , ['date_fin' ,'<' , Carbon::now()] ])->first();
            if( $coup) {
                $com->id_coupon =  $coup->id ;
                $SetCoupon  = $coup->taux;
            }else {
                alert()->error('Coupon exipiré ou non valide.', '')->toToast();
                return back();
            }


        }

        $liv = Livreur::find( $id_livreur);
        if($liv)
            $liv = $liv->frais;
        else
            $liv = 0;
        $sommeTax = 0 ;
        foreach (Cart::content() as $art){
            $sommeTax += $art->total * $art->model->taux_tva/100;
        }

        $com->id_client = Auth::user()->id;
        $com->description = "";
        $com->id_livreur = $id_livreur;
        $com->total = Cart::total(2,'.','') + $sommeTax + $liv -  (Cart::total(2,'.','')*$SetCoupon /100);
        $com->save();

        $articles = [] ;
        foreach (Cart::content() as $key => $art) {
            $articles[$art->id] = ['qty' => $art->qty] ;
        }
        $com->article()->attach( $articles);

        alert()->success('Commande bien passé.', '')->toToast();
        Cart::destroy();
        Mail::to(auth()->user()->email)->send(new OrederCompleted(Commande::find($com->id)));
        return view('boutique.commande.success');
    }
}
