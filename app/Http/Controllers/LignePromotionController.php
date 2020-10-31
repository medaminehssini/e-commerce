<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\LignePromotion;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LignePromotionController extends Controller
{
    public function index ($id)  {
        $data=  Promotion::find($id);
        if ($data) {
            $article = Article::get();
            return view('admin.promotion.ligne_promotion.list' )->with('articles',$article);

        }else {
            return back();
        }
    }


    public function promotionData($id)
    {

        $data=  Promotion::find($id);
        if($data) {



        return DataTables::of( $data->article)
        ->addColumn('action', function ($article) {
            return '<span class="action-edit" onclick=\'openUpdate('.$article.')\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/ligne/promotion/').'/' . $article->pivot->id_promotion.'/'.$article->id.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })
        ->addColumn('photo', function ($article) {
            $u = url('');
            return '<img src="'. $u . explode(',',$article->images)[0] .'" alt="Img placeholder">';
        })

        ->addColumn('prix_prom', function ($article) {

            return  number_format((float)$article->prix*(1-$article->pivot->taux/100), 2, '.', '');
        })

        ->rawColumns([ 'prix_prom' , 'photo',  'action' ])

        ->make(true);
        }

    }


    public function addPromotion (Request $request , $id   ) {

        $promotion = Promotion::find($id) ;
        $article = Article::find($request->article);
        if($promotion && $article ) {
            $promotion->article()->attach($request->article , ['qty' => $request->qty , 'taux' => $request->taux ]);
        }

        return back();
    }

    public function editPromotion  ( Request $request , $id ) {




        $promotion =   Promotion::find($id ) ;
        $article = Article::find($request->article);
        if($promotion && $article  )
        {
            $promotion->article()->detach($request->article);
            $promotion->article()->attach($request->article , ['qty' => $request->qty , 'taux' => $request->taux ]);

        }




        return back();
    }


    public function remove ($id , $article) {


        $promotion = Promotion::find($id ) ;

        if($promotion)
        {
            $promotion->article()->detach($article);

        }

        return back();
    }
}
