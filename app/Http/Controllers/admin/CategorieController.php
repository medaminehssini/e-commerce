<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

        $validator = Validator::make($request->all(), [

            'nom' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif'
        ], $messages);

        if(  $validator->fails()){
            return response()->json($validator->errors()->all() , 400);
        }

        if($request->hasfile('image'))
        {


                $name = time().'.'.$request->image->extension();
                $request->image->move(public_path().'/uploads/img/categorie', $name);
                $nameImage = '/uploads/img/categorie/'.$name;


        }

        $Categorie = new  Categorie() ;

        if($request->icon || $request->categorie){
                if($request->icon){
                    $Categorie->icon = $request->icon;

                }else {
                    $Categorie->id_categorie = $request->categorie;
                }
        }else {
            alert()->success('icon ou categorie', '')->toToast();

        }



        $Categorie->image       = $nameImage;
        $Categorie->nom      = $request->nom;


        $Categorie->save();


        return response()->json(['success' => 'Catégorie bien ajoutée'],200);

    }

    public function editCategorie  ( Request $request , $id ) {

        $messages = [
            'nom.required' => 'Champs libelle obligatoire',
        ];

        $validator = Validator::make($request->all(), [

            'nom' => 'required',
        ], $messages);
        if(  $validator->fails()){
            return response()->json($validator->errors()->all() , 400);
        }
        $nameImage = null;
        if($request->hasfile('image'))
        {
            $validator = Validator::make($request->all(), [

                'image' => 'mimes:jpg,jpeg,png,gif'
            ]);
            if(  $validator->fails()){
                return response()->json($validator->errors()->all() , 400);
            }

            $name = time().'.'.$request->image->extension();
            $request->image->move(public_path().'/uploads/img/categorie', $name);
            $nameImage = '/uploads/img/categorie/'.$name;

        }

        $Categorie =   Categorie::find($id ) ;


        if($request->icon || $request->categorie){
            if($request->icon){
                $Categorie->icon = $request->icon;

                }else {
                    $Categorie->id_categorie = $request->categorie;
                }
        }else {
            alert()->success('icon ou categorie', '')->toToast();

        }


        if($Categorie)
        {
            if ($nameImage) $Categorie->image      = $nameImage;
            $Categorie->nom      = $request->nom;

            $Categorie->save();


        }

        return response()->json(['success' => 'Catégorie bien modifiée'],200);



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
