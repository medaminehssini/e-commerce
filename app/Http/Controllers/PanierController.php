<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Coupon;
use App\Models\Livreur;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PanierController extends Controller
{

    public function index()
    {
        if (Cart::count()> 0) {

            $coupon= 0 ;
            $fraislivreur = 0;
            if(request()->livreur){
                $livreur = Livreur::find(request()->livreur);
                if($livreur ) {
                    $fraislivreur = $livreur->frais;
                }
            }
            // if(request()->coupon){
            //     $coup = Coupon::where(['code'=>request()->coupon , ['qty' ,'>' , '0'] ])->orWhere(['code'=>request()->coupon , ['qty' ,'>' , '0'] ])->first();
            //     if( $coup) {
            //         $coupon=$coup->taux;
            //     }
            // }
            $livreurs = Livreur::get();
            $arts = Article::get();
            return view('boutique.panier.panier')->with([
                'livreur'=>$livreurs,
                'articles' => $arts,
                'coupon' => $coupon,
                'fraislivreur'=>$fraislivreur
                ]);
        }else {
            alert()->error('ajouter ou moin un produit.', '')->toToast();
            return back();
        }
    }

    public function addPanier($id)
    {
        $art = Article::find($id);
        $duplicata = Cart::search(function ($cartItem, $rowId) use($art) {
            if ($cartItem->id == $art->id) {
                $cartItem->qty = $cartItem->qty +1 ;
                return $cartItem->id == $art->id;
            }
        });

         if (!$duplicata->isNotEmpty()) {
            //  alert()->warning('Le produit déja ajouté.', '')->toToast();
            Cart::add($art->id,$art->libelle,1,$art->prix , ["image"=> explode(",", $art->images)[0]])
            ->associate('App\Models\Article');
         }


        alert()->success('Le produit à été bien ajouté.', '')->toToast();
        return back();
    }

    public function removePanier($id)
    {
        Cart::remove($id);
        alert()->success('Article bien retiré.', '')->toToast();
        return back();
    }


    public function recalculer(Request $request)
    {
        $data =  json_decode($request->json);

        foreach ($data as   $art) {
            $duplicata = Cart::search(function ($cartItem, $rowId) use($art) {
                if ($cartItem->id == $art->id) {
                    $cartItem->qty = $art->qty;
                }
            });
        }

        alert()->success('Le produit à été bien modifiée.', '')->toToast();
        return back();

    }
}
