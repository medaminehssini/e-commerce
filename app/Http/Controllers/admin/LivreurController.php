<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LivreurController extends Controller
{
    public function index ()  {

        return view('admin.livreur.livreur');
    }


    public function livreurData()
    {
        return DataTables::of(Livreur::get())
        ->addColumn('action', function ($Livreur) {
            return '<span class="action-edit" onclick=\'openUpdate('.$Livreur.')\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/livreur/').'/'.$Livreur->id.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })
        ->addColumn('action', function ($Livreur) {
            return '<span class="action-edit" onclick=\'openUpdate('.$Livreur.')\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/livreur/').'/'.$Livreur->nom.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })
        ->addColumn('action', function ($Livreur) {
            return '<span class="action-edit" onclick=\'openUpdate('.$Livreur.')\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/livreur/').'/'.$Livreur->frais.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })
        ->addColumn('action', function ($Livreur) {
            return '<span class="action-edit" onclick=\'openUpdate('.$Livreur.')\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/livreur/').'/'.$Livreur->delai.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })

        ->rawColumns(['photo' , 'action' ])

        ->make(true);
    }


    public function addLivreur (Request $request) {

        $messages = [
            'nom.required' => 'Champs nom obligatoire',
            'frais.required' => 'Champs frais obligatoire',
            'frais.integer' => 'Champs frais doit être un entier',
            'delai.required' => 'Champs delai obligatoire',
            'delai.integer' => 'Champs delai doit être un entier',
        ];

        $this->validate($request, [

            'nom' => 'required',
            'frais' => 'required|integer',
            'delai' => 'required|integer',
        ], $messages);


        $Livreur = new  Livreur() ;


        $Livreur->nom       = $request->nom;
        $Livreur->frais      = $request->frais;
        $Livreur->delai      = $request->delai;


        $Livreur->save();
        alert()->success('Livreur bien ajoutée', '')->toToast();

        return back();
    }

    public function editLivreur  ( Request $request , $id ) {

        $messages = [
            'nom.required' => 'Champs nom obligatoire',
            'frais.required' => 'Champs frais obligatoire',
            'frais.integer' => 'Champs frais doit être un entier',
            'delai.required' => 'Champs delai obligatoire',
            'delai.integer' => 'Champs delai doit être un entier',
        ];

        $this->validate($request, [

            'nom' => 'required',
            'frais' => 'required|integer',
            'delai' => 'required|integer',
        ], $messages);

        $Livreur =   Livreur::find($id ) ;

        if($Livreur)
        {
            $Livreur->nom      = $request->nom;
            $Livreur->frais      = $request->frais;
            $Livreur->delai      = $request->delai;

            $Livreur->save();
            alert()->success('Livreur bien modifiée', '')->toToast();

        }




        return back();
    }


    public function remove ($id) {


        $Livreur = Livreur::find($id ) ;

        if($Livreur)
        {
            $Livreur->delete();
            alert()->success('Livreur bien supprimée', '')->toToast();

        }

        return back();
    }
}
