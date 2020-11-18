<?php

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Livreur;
use App\Models\Promotion;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

function aurl ($url=null) {
            return url('admin/'.$url);
        }


        function getCategories()
        {
            return Categorie::get();
        }


        function FindPromArticle ($id) {

            $promotions =  Promotion::whereDate('date_debut', '<', Carbon::today())->whereDate('date_fin', '>', Carbon::today())->get();
            $prom = 0;
            foreach ($promotions as $key => $promotion) {
                foreach ($promotion->article as  $value) {
                    if($value->id == $id && $prom <$value->pivot->taux)
                        {$prom = $value->pivot->taux;
                         break;}
                }
            }
            return  $prom;
        }



        function getPrixWithProm ($prix , $prom) {
            return number_format($prix *   ((100-$prom)/100), 2, '.', ',');
        }

        function getArticleRate ($id ) {
            $art = Article::find($id);
            $nbr = 0 ;
            foreach ($art->commentaire as $key => $value) {
                $nbr +=    $value->pivot->rate;
            }
            if(count($art->commentaire) > 0)
            return $nbr/count($art->commentaire) ;


            return 0 ;
        }


        function verifCommandeArticle ($id) {
            $verif = false ;
            if(Auth::check()){
                $user = User::find(Auth::user()->id);
                if ($user) {
                    foreach ($user->commande as  $commande) {
                       foreach ($commande->article as  $article) {
                          if($commande->etat == 3 &&  $article->id  == $id) {
                             $verif = true;
                          }
                       }
                    }
                }
            }
            return $verif ;
        }

        function getFraisLiv($id){
            return Livreur::find($id)->frais;
        }

        function wishCount()
        {
            if(Auth::check()){
                $user = User::find(Auth::user()->id);
                if($user){
                    return $user->wishList->count();
                }
            }
            return 0;
        }

        function getSetting ($key) {
            $result = Setting::where('mot' , $key)->first();
            if($result) {
                return $result->description;
            }
            return '';
        }

        function getMenuCategories() {
            return Categorie::where('id_categorie' , 0)->get();
        }

        function popularArticle($id) {
           return Article::where("id_categorie", $id)->withCount('commande')->latest('commande_count')->take(9)->get();
        }

        function getImageFromCategorie($categorie)  {
            $cats =    Categorie::find($categorie);
            $images = [];
            if($cats) {
               $image1 =  random_int (0     , count($cats->categorie)-1 );
               $image2 =  random_int (0     , count($cats->categorie)-1 );
               $images[0] = $cats->categorie[$image1]->image ;
               $images[1] = $cats->categorie[$image2]->image ;

            }

            return $images;
        }
