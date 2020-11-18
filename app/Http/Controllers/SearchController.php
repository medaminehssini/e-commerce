<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Marque;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $nbrPaginate = 9;
        $orderBy = 'created_at';
        $desc_asc = 'desc';

        $filtres = [];
        if (request()->show != '') {
            $nbrPaginate = (int)request()->show;
        }
        if (request()->categorie != '') {
            $filtres[count($filtres)] =[ "id_categorie" ,  request()->categorie];
        }
        if (request()->marque != '') {
            $filtres[count($filtres)] =[ "id_marque" ,  request()->marque];
        }
        if (request()->libelle != '') {
            $filtres[count($filtres)] =[ "libelle"  , 'LIKE',  '%'.request()->libelle.'%'];
        }
        if (request()->prix_min != '' && request()->prix_max != '' ) {
            $filtres[count($filtres)] =[ "prix"  , '>=', request()->prix_min ];
            $filtres[count($filtres)] =[ "prix"  , '<=', request()->prix_max ];
        }
        if (request()->orderBy != '' ) {
            $order =  explode(",", request()->orderBy );
            if (($order[1] == 'asc' || $order[1] == 'desc') && ($order[0] == 'created_at' || $order[0] == 'prix') ) {
                $orderBy = $order[0];
                $desc_asc = $order[1];
            }
        }

        $prix = [];
        $prix[0] = Article::min("prix");
        $prix[1] = Article::max("prix");



        $articles = Article::where($filtres)->where("qty" , '>' , 0)->orderBy($orderBy , $desc_asc)->paginate($nbrPaginate);
        $categorie = Categorie::get();
        $marque = Marque::get();
        return view('boutique.search.search')->with([
            "articles" => $articles,
            "marques" => $marque,
            "categories" => $categorie,
            "prix"=>$prix,
        ]);
    }

    public function getarticle()
    {
        if(request()->name)  {
            if(request()->categorie != '' && request()->categorie != 0)
                return Article::where("qty" , '>' , 0)->where('libelle','LIKE' , '%'.request()->categorie.'%')->where('id_categorie', request()->categorie)->take(6)->get();
            else
                return Article::where("qty" , '>' , 0)->where('libelle','LIKE' , '%'.request()->name.'%')->take(6)->get();
        }else {
           return  response()->json([],200);
        }
    }
}
