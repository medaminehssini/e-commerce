<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function addPanier($id)
    {
        $art = Article::find($id);
        $duplicata = Cart::search(function ($cartItem, $rowId) use($art) {
            return $cartItem->id == $art->id;
        });

        if ($duplicata->isNotEmpty()) {
            alert()->warning('Le produit déja ajouté.', '')->toToast();
            return back();
        }
        Cart::add($art->id,$art->libelle,1,$art->prix)
        ->associate('App\Article');
        // dd(Cart::content());
        alert()->success('Le produit à été bien ajouté.', '')->toToast();
        return back();
    }

    public function removePanier($id)
    {
        Cart::remove($id);
        alert()->success('Article bien retiré.', '')->toToast();
        return back();
    }
}
