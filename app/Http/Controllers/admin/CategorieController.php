<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategorieController extends Controller
{
    public function index ()  {

        $cat = Categorie::get();
        return view('admin.categorie.list')->with('categories' , $cat);
    }


    public function categorieData()
    {
        return DataTables::of(Categorie::with('categorie')->get())
        ->addColumn('action', function ($categorie) {
            return '<span class="action-edit" onclick=\'openUpdate('.$categorie.')\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/categorie/').'/'.$categorie->id.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })
        ->addColumn('photo', function ($categorie) {
                $u = url('').'/';
            return '<img src="'. $u .  $categorie->image .'" alt="Img placeholder">';
        })

        ->rawColumns(['photo' , 'action' ])

        ->make(true);
    }


    public function addCategorie (Request $request) {


        $messages = [
            'image.required' => 'Vous devez ajouter une photo',
            'image.mimes' => 'Format image invalide',
            'nom.required' => 'Champs libelle obligatoire',
        ];

        $this->validate($request, [

            'nom' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif'
        ], $messages);


        if($request->hasfile('image'))
        {


                $name = time().'.'.$request->image->extension();
                $request->image->move(public_path().'/uploads/img/categorie', $name);
                $nameImage = '/uploads/img/categorie/'.$name;


        }

        $Categorie = new  Categorie() ;


        $Categorie->image       = $nameImage;
        $Categorie->id_categorie = $request->categorie;
        $Categorie->nom      = $request->nom;


        $Categorie->save();

        alert()->success('Catégorie bien ajoutée', '')->toToast();

        return back();
    }

    public function editCategorie  ( Request $request , $id ) {

        $messages = [
            'image.required' => 'Vous devez ajouter une photo',
            'image.mimes' => 'Format image invalide',
            'nom.required' => 'Champs libelle obligatoire',
        ];

        $this->validate($request, [

            'nom' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif'
        ], $messages);

        $nameImage = null;
        if($request->hasfile('image'))
        {
            $this->validate($request, [

                'image' => 'mimes:jpg,jpeg,png,gif'
            ]);


            $name = time().'.'.$request->image->extension();
            $request->image->move(public_path().'/uploads/img/categorie', $name);
            $nameImage = '/uploads/img/categorie/'.$name;

        }

        $Categorie =   Categorie::find($id ) ;

        if($Categorie)
        {
            if ($nameImage) $Categorie->image      = $nameImage;
            $Categorie->id_categorie = $request->categorie;
            $Categorie->nom      = $request->nom;

            $Categorie->save();

            alert()->success('Catégorie bien modifiée', '')->toToast();
        }



        return back();
    }


    public function remove ($id) {


        $Categorie = Categorie::find($id ) ;

        if($Categorie)
        {
            $Categorie->delete();
            alert()->success('Catégorie bien supprimée', '')->toToast();

        }

        return back();
    }
}
