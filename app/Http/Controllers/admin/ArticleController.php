<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Marque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class ArticleController extends Controller
{
    public function index ()  {
        $cat = Categorie::all();
        $marque = Marque::all();
        return view('admin.article.list')->with(['categories' => $cat , 'marques' => $marque]  );
    }


    public function ArticleData()
    {
        return Datatables::of(Article::with('categorie' , 'marque')->get())
        ->addColumn('action', function ($article) {
            return '<span class="action-edit" onclick=\'openUpdate(JSON.stringify('.$article.'))\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/article/').'/'.$article->id.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })
        ->addColumn('photo', function ($article) {
                $u = url('');
            return '<img src="'. $u . explode(',',$article->images)[0] .'" alt="Img placeholder">';
        })
        ->addColumn('statusDetails', function ($article) {

            $message = '';
            switch ($article->status) {
                case 0:
                    $message = '            <div class="chip chip-primary">
                    <div class="chip-body">
                        <div class="chip-text">pending</div>
                    </div>
                </div>';
                    break;
                case 1:
                    $message = '<div class="chip chip-success">
                        <div class="chip-body">
                            <div class="chip-text">delivered</div>
                        </div>
                    </div>';
                    break;
                case 2:
                    $message = '<div class="chip chip-warning">
                    <div class="chip-body">
                        <div class="chip-text">on hold</div>
                    </div>
                </div>';
                    break;
                case 3:
                    $message = '            <div class="chip chip-danger">
                    <div class="chip-body">
                        <div class="chip-text">canceled</div>
                    </div>
                </div>';
                    break;
            }
            return $message ;
        })
        ->rawColumns(['photo' , 'action' , 'statusDetails'])

        ->make(true);
    }


    public function addArticle (Request $request) {

        $messages = [
            'images.required' => 'Vous devez ajouter au moins une photo',
            'images.mimes' => 'Format image invalide',
            'libelle.required' => 'Champs libelle obligatoire',
            'prix.required' => 'Champs prix obligatoire',
            'qty.required' => 'Champs quantité obligatoire',
            'prix.min' => 'Champs prix invalide',
            'qty.min' => 'Champs quantité invalide',
            'description.required' => 'Champs description obligatoire',

        ];

        $validator = Validator::make($request->all(), [
            'images' => 'required',
            'images.*' => 'mimes:jpg,jpeg,png,gif',
            'libelle' => 'required',
            'prix' => 'required|numeric|min:1',
            'qty' => 'required|numeric|min:1',
            'description' => 'required',
        ], $messages);

        if(  $validator->fails()){
            return response()->json($validator->errors()->all() , 400);
        }

        $images  = [] ;
        $i= 0 ;
        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $key=> $file)
            {

                $name = time().$key.'.'.$file->extension();
                $file->move(public_path().'/uploads/img/articles', $name);
                $images[$i] = '/uploads/img/articles/'.$name;
                $i++;
            }
        }

        $article = new  Article() ;


        $article->images       = implode(",", $images);
        $article->id_categorie = $request->categorie;
        $article->libelle      = $request->libelle;
        $article->prix         = $request->prix;
        $article->description  = $request->description;
        $article->status       = 0;
        $article->qty          = $request->qty;
        $article->taux_tva     = $request->taux_tva;
        $article->id_marque    = $request->marque;


        $article->save();


        return response()->json(['success' => 'Article bien ajouté'],200);
    }

    public function editArticle  ( Request $request , $id ) {

        $messages = [
            'images.mimes' => 'Format image invalide',
            'libelle.required' => 'Champs libelle obligatoire',
            'prix.required' => 'Champs prix obligatoire',
            'qty.required' => 'Champs quantité obligatoire',
            'prix.min' => 'Champs prix invalide',
            'qty.min' => 'Champs quantité invalide',
            'description.required' => 'Champs description obligatoire',

        ];

        $validator = Validator::make($request->all(), [
            'images.*' => 'mimes:jpg,jpeg,png,gif',
            'libelle' => 'required',
            'prix' => 'required|numeric|min:1',
            'qty' => 'required|numeric|min:1',
            'description' => 'required',
        ], $messages);
        if(  $validator->fails()){
            return response()->json($validator->errors()->all() , 400);
        }

        $images  = [] ;
        $i= 0 ;
        if($request->hasfile('images'))
        {
            $validator = Validator::make($request->all(), [

                'images.*' => 'mimes:jpg,jpeg,png,gif'
            ]);
            if(  $validator->fails()){
                return response()->json($validator->errors()->all() , 400);
            }
            foreach($request->file('images') as $key => $file)
            {

                $name = time().$key.'.'.$file->extension();
                $file->move(public_path().'/uploads/img/article', $name);
                $images[$i] = '/uploads/img/article/'.$name;
                $i++;
            }
        }

        $article =   Article::find($id ) ;

        if($article)
        {
            if (count($images)>0) $article->images      = implode(",", $images);
            $article->id_categorie = $request->categorie;
            $article->libelle      = $request->libelle;
            $article->prix         = $request->prix;
            $article->description  = $request->description;
            $article->status       = 0;
            $article->qty          = $request->qty;
            $article->taux_tva     = $request->taux_tva;
            $article->id_marque    = $request->marque;
            $article->save();


        }




        return response()->json(['success' => 'Article bien modifié'],200);

    }


    public function remove ($id) {


        $article = Article::find($id ) ;

        if($article)
        {
            $article->delete();
            alert()->success('Article bien supprimé', '')->toToast();


        }

        return back();
    }
}
