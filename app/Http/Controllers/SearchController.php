<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {

        $filtres = [];
        if (request()->categorie != '') {
            $filtres["id_categorie"] = request()->categorie;
        }
        if (request()->libelle != '') {
            $articles = Article::where($filtres)->where('libelle' , 'LIKE', '%'.request()->libelle.'%' )->paginate(9);

        }else
            $articles = Article::where($filtres)->paginate(9);


        return view('boutique.search.search')->with([
            "articles" => $articles,
        ]);
    }
}
