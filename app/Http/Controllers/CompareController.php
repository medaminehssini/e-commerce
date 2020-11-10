<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompareController extends Controller
{


    public function index () {
        if(session()->has('compare')) {
            $compares = Session::get('compare');
            $compare = Article::whereIn('id' , $compares )->get();
        }else {
            $compare = [];
        }
        return view('boutique.compare.compare')->with("compares" , $compare);
    }

    public function addItem ($id)
    {
        $compare = [];
        if(session()->has('compare')) {
            $compare = Session::get('compare');
            $verif = false;
            foreach ($compare as $key => $value) {
                if( $value == $id ){
                    $verif = true;
                }
            }

            if(!$verif) {
                if(count($compare) >=3 ){
                    $compare[2] = $id ;

                }else
                $compare[count($compare)] = $id ;
                Session::put('compare', $compare);

            }
        }else {
            $compare[0] = $id;
            Session::put('compare', $compare);
        }


        return back() ;

    }

    public function RemoveItem ($id)
    {
        $compare = [];
        if(session()->has('compare')) {
            $compare = Session::get('compare');
            $ncompare = [];
            $i = 0;
            foreach ($compare as $value) {
                if( $value != $id ){
                    $ncompare[$i] = $value;
                    $i++;
                }
            }
            Session::put('compare', $ncompare);


        }
        return back() ;

    }
}
