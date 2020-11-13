<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Contact;
use App\Models\Marque;
use App\Models\Promotion;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('article')->latest('article_count')->take(10)->get();
        $marques = Marque::withCount('article')->latest('article_count')->take(10)->get();
        $newArticle = Article::whereHas('promotion', function ($q)  {
            $q->where('date_fin', '>' , Carbon::now() );
        })->where("qty" , '>' , 0)->latest()->take(10)->get();
        $specialOffres = Article::whereHas('promotion', function ($q)  {
            $q->where('date_fin', '>' , Carbon::now() );
        })->where("qty" , '>' , 0)->take(10)->get();

        $bestpromSellers = Article::whereHas('promotion', function ($q)  {
            $q->where('date_fin', '>' , Carbon::now() );
        })->withCount('commande')->where("qty" , '>' , 0)->latest('commande_count')->take(10)->get();


        $bestSellers = Article::withCount('commande')->where("qty" , '>' , 0)->latest('commande_count')->take(10)->get();

        $contact = Contact::where('publish_state' , 1 )->take(10)->get();

        $slider = Slider::where('status' , 1 )->get();
        return view('boutique.welecome')->with([
            'categories'=>$categories,
            'marques'=>$marques,
            'newArticles' => $newArticle,
            "specialOffres"=> $specialOffres,
            "bestSellers"=>$bestSellers,
            "bestpromSellers"=>$bestpromSellers,
            "contacts"=>$contact,
            "sliders"=>$slider
        ]);
    }
}
