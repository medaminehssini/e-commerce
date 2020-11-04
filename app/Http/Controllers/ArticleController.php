<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Marque;
use Illuminate\Http\Request;
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
            return '<span class="action-edit" onclick=\'openUpdate('.$article.')\'><i class="feather icon-edit"></i></span>
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
            'status.required' => 'Vous devez spécifier une état',
            
        ];

        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'mimes:jpg,jpeg,png,gif',
            'libelle' => 'required',
            'prix' => 'required|numeric|min:1',
            'qty' => 'required|numeric|min:1',
            'description' => 'required',
            'status' => 'required',
        ], $messages);

        $images  = [] ;
        $i= 0 ;
        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $file)
            {

                $name = time().'.'.$file->extension();
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
        $article->status       = $request->status;
        $article->qty          = $request->qty;
        $article->taux_tva     = $request->taux_tva;
        $article->id_marque    = $request->marque;


        $article->save();

        return back();
    }

    public function editArticle  ( Request $request , $id ) {

        $messages = [
            'images.required' => 'Vous devez ajouter au moins une photo',
            'images.mimes' => 'Format image invalide',
            'libelle.required' => 'Champs libelle obligatoire',
            'prix.required' => 'Champs prix obligatoire',
            'qty.required' => 'Champs quantité obligatoire',
            'prix.min' => 'Champs prix invalide',
            'qty.min' => 'Champs quantité invalide',
            'description.required' => 'Champs description obligatoire',
            'status.required' => 'Vous devez spécifier une état',
            
        ];

        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'mimes:jpg,jpeg,png,gif',
            'libelle' => 'required',
            'prix' => 'required|numeric|min:1',
            'qty' => 'required|numeric|min:1',
            'description' => 'required',
            'status' => 'required',
        ], $messages);


        $images  = [] ;
        $i= 0 ;
        if($request->hasfile('images'))
        {
            $this->validate($request, [

                'images.*' => 'mimes:jpg,jpeg,png,gif'
            ]);
            foreach($request->file('images') as $file)
            {

                $name = time().'.'.$file->extension();
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
            $article->status       = $request->status;
            $article->qty          = $request->qty;
            $article->taux_tva     = $request->taux_tva;
            $article->id_marque    = $request->marque;
            $article->save();
        }




        return back();
    }


    public function remove ($id) {


        $article = Article::find($id ) ;

        if($article)
        {
            $article->delete();

        }

        return back();
    }
}
