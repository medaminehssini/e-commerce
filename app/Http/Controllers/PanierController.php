<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Coupon;
use App\Models\Livreur;
use Carbon\Carbon;
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
            if(request()->coupon){
                $coup = Coupon::where(['code'=>request()->coupon , ['qty' ,'>' , '0'] ])->orWhere(['code'=>request()->coupon  , ['date_fin' ,'<' , Carbon::now()] ])->first();
                if( $coup) {
                    $coupon=$coup;
                }else {
                    $coupon= -1;
                }
            }
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
        $qty = 1 ;
        $art = Article::find($id);



        if($art ){
            if(request()->qty && request()->qty>0) {
                $qty = (int)request()->qty ;
                if($qty  > $art->qty){
                    alert()->error('Vous avez atteint la taille de stoke.', '')->toToast();
                    return back();
                }
            }

            $duplicata = Cart::search(function ($cartItem, $rowId) use($art , $qty  ) {
                if ($cartItem->id == $art->id) {
                    if (request()->qty  && request()->qty>0 ) {
                        $cartItem->qty = $qty;
                    }else{

                        if($cartItem->qty + 1 > $art->qty )
                        {
                            $cartItem->qty = 0;
                        }else {
                            $cartItem->qty = $cartItem->qty +1 ;
                        }

                    }

                    return $cartItem->id == $art->id;
                }
            });

                if ($duplicata->isNotEmpty()) {
                    if (Cart::content()->where('id', $id)->first()->qty == 0 ) {
                        Cart::content()->where('id', $id)->first()->qty = $art->qty;
                        alert()->error('Vous avez atteint la taille de stoke.', '')->toToast();
                        return back();
                    }

                }

             if (!$duplicata->isNotEmpty()) {
                //  alert()->warning('Le produit déja ajouté.', '')->toToast();
                Cart::add($art->id,$art->libelle,$qty,$art->prix , ["image"=> explode(",", $art->images)[0]])
                ->associate('App\Models\Article');
             }


            alert()->success('Le produit à été bien ajouté.', '')->toToast();

        }else
            abort(404);

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
