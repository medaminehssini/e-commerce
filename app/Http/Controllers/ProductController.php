<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getArticle ( $id) {
        $article = Article::find($id);
        if ($article) {


            $promotions =  Promotion::whereDate('date_debut', '<', Carbon::today())->whereDate('date_fin', '>', Carbon::today())->get();
            $prom = 0;
            foreach ($promotions as $key => $promotion) {
                foreach ($promotion->article as  $value) {
                    if($value->id == $article->id && $prom <$value->pivot->taux)
                        {$prom = $value->pivot->taux;
                         break;}
                }
            }
            $article->off = $prom;
            $article->prixWithPromotion = number_format($article->prix *   ((100-$prom)/100), 2, '.', ',');


                return view('boutique.article.article')->with(['article'=>$article]);



        }else
            abort(404);
    }

    public function getQuikArticle ( $id) {
        $article = Article::find($id);
        if ($article) {


            $promotions =  Promotion::whereDate('date_debut', '<', Carbon::today())->whereDate('date_fin', '>', Carbon::today())->get();
            $prom = 0;
            foreach ($promotions as $key => $promotion) {
                foreach ($promotion->article as  $value) {
                    if($value->id == $article->id && $prom <$value->pivot->taux)
                        {$prom = $value->pivot->taux;
                         break;}
                }
            }
            $article->off = $prom;
            $article->prixWithPromotion = number_format($article->prix *   ((100-$prom)/100), 2, '.', ',');

                return view('boutique.article.quick')->with(['article'=>$article]);


        }else
            abort(404);
    }
}
