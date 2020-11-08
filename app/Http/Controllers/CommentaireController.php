<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{

    public function addCommentaire (Request $request , $id   ) {

        $article = Article::find($id) ;
        if($article ) {
            $article->commentaire()->detach(Auth::user()->id);

            $article->commentaire()->attach(Auth::user()->id , ['rate' => $request->rate , 'description' => $request->description ]);
        }

        return back();
    }
}
