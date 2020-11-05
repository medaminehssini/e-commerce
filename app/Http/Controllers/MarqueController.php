<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MarqueController extends Controller
{
    public function index ()  {

        return view('admin.marque.list');
    }


    public function marqueData()
    {
        return DataTables::of(Marque::get())
        ->addColumn('action', function ($Marque) {
            return '<span class="action-edit" onclick=\'openUpdate('.$Marque.')\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/marque/').'/'.$Marque->id.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })
        ->addColumn('photo', function ($Marque) {
                $u = url('').'/';
            return '<img src="'. $u .  $Marque->logo .'" alt="Img placeholder">';
        })

        ->rawColumns(['photo' , 'action' ])

        ->make(true);
    }


    public function addMarque (Request $request) {

        $messages = [
            'image.required' => 'Vous devez ajouter une photo',
            'image.mimes' => 'Format logo invalide',
            'nom.required' => 'Champs libelle obligatoire',
        ];

        $this->validate($request, [

            'nom' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif'
        ], $messages);



        if($request->hasfile('image'))
        {


                $name = time().'.'.$request->image->extension();
                $request->image->move(public_path().'/uploads/img/marque', $name);
                $nameImage = '/uploads/img/marque/'.$name;


        }

        $Marque = new  Marque() ;


        $Marque->logo       = $nameImage;
        $Marque->libelle      = $request->nom;


        $Marque->save();
        alert()->success('Marque bien ajoutée', '')->toToast();

        return back();
    }

    public function editMarque  ( Request $request , $id ) {

        $messages = [
            'image.required' => 'Vous devez ajouter une photo',
            'image.mimes' => 'Format logo invalide',
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

                'logo' => 'mimes:jpg,jpeg,png,gif'
            ]);


            $name = time().'.'.$request->image->extension();
            $request->image->move(public_path().'/uploads/img/marque', $name);
            $nameImage = '/uploads/img/marque/'.$name;

        }

        $Marque =   Marque::find($id ) ;

        if($Marque)
        {
            if ($nameImage) $Marque->logo      = $nameImage;
            $Marque->libelle      = $request->nom;

            $Marque->save();
            alert()->success('Marque bien modifiée', '')->toToast();

        }




        return back();
    }


    public function remove ($id) {


        $Marque = Marque::find($id ) ;

        if($Marque)
        {
            $Marque->delete();
            alert()->success('Marque bien supprimée', '')->toToast();

        }

        return back();
    }
}
