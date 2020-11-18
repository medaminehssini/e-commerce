<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    public function index ()  {

        return view('admin.coupon.list');
    }


    public function couponData()
    {
        return DataTables::of(Coupon::get())
        ->addColumn('action', function ($Coupon) {
            return '<span class="action-edit" onclick=\'openUpdate('.$Coupon.')\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/coupon/').'/'.$Coupon->id.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })


        ->rawColumns([ 'action' ])

        ->make(true);
    }


    public function addCoupon (Request $request) {

        $messages = [
            'taux.required' => 'Champs taux obligatoire',
            'taux.min' => 'Taux invalide',
            'code.required' => 'Champs code obligatoire',
            'qty.required' => 'Champs quantité obligatoire',
            'qty.min' => 'Quantité invalide',
            'date_fin.after' => 'Date  invalide',
            'prix_min.min' =>  'Prix invalide',
            'date_fin.required' => 'Champs date obligatoire',
            'prix_min.required' =>  'Champs prix obligatoire '
        ];

        $validator = Validator::make($request->all(), [

            'code' => 'required',
            'qty' => 'required|numeric|min:1',
            'taux' =>  'required|numeric|min:1',
            'date_fin' => 'required|date|after:tomorrow',
            'prix_min' =>  'required|numeric|min:1'
        ], $messages);
        if(  $validator->fails()){
            return response()->json($validator->errors()->all() , 400);
        }
        $Coupon = new  Coupon() ;


        $Coupon->code     = $request->code;
        $Coupon->qty      = $request->qty;
        $Coupon->taux     = $request->taux;
        $Coupon->date_fin = $request->date_fin;
        $Coupon->prix_min = $request->prix_min;


        $Coupon->save();

        return response()->json(['success' => 'Coupon bien ajoutée'],200);

    }

    public function editCoupon  ( Request $request , $id ) {

        $messages = [
            'taux.required' => 'Champs taux obligatoire',
            'taux.min' => 'Taux invalide',
            'code.required' => 'Champs code obligatoire',
            'qty.required' => 'Champs quantité obligatoire',
            'qty.min' => 'Quantité invalide',
            'date_fin.after' => 'Date  invalide',
            'prix_min.min' =>  'Prix invalide',
            'date_fin.required' => 'Champs date obligatoire',
            'prix_min.required' =>  'Champs prix obligatoire '
        ];

        $validator = Validator::make($request->all(), [

            'code' => 'required',
            'qty' => 'required|numeric|min:1',
            'taux' =>  'required|numeric|min:1',
            'date_fin' => 'required|date|after:today',
            'prix_min' =>  'required|numeric|min:1'
        ], $messages);
        if(  $validator->fails()){
            return response()->json($validator->errors()->all() , 400);
        }


        $Coupon =   Coupon::find($id ) ;

        if($Coupon)
        {
            $Coupon->code     = $request->code;
            $Coupon->qty      = $request->qty;
            $Coupon->taux     = $request->taux;
            $Coupon->date_fin = $request->date_fin;
            $Coupon->prix_min = $request->prix_min;
            $Coupon->save();


        }




        return response()->json(['success' => 'Coupon bien modifié'],200);

    }


    public function remove ($id) {


        $Coupon = Coupon::find($id ) ;

        if($Coupon)
        {
            $Coupon->delete();
            alert()->success('Coupon bien supprimé', '')->toToast();


        }

        return back();
    }
}
