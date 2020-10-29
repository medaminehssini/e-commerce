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
        $this->validate($request, [

            'image' => 'required|mimes:jpg,jpeg,png,gif'
        ]);


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

        return back();
    }

    public function editMarque  ( Request $request , $id ) {



        $nameImage = null;
        if($request->hasfile('image'))
        {
            $this->validate($request, [

                'image' => 'mimes:jpg,jpeg,png,gif'
            ]);


            $name = time().'.'.$request->image->extension();
            $request->image->move(public_path().'/uploads/img/marque', $name);
            $nameImage = '/uploads/img/marque/'.$name;

        }

        $Marque =   Marque::find($id ) ;

        if($Marque)
        {
            if ($nameImage) $Marque->image      = $nameImage;
            $Marque->libelle      = $request->nom;

            $Marque->save();
        }




        return back();
    }


    public function remove ($id) {


        $Marque = Marque::find($id ) ;

        if($Marque)
        {
            $Marque->delete();

        }

        return back();
    }
}
