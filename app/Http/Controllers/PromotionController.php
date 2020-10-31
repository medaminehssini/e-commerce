<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class PromotionController extends Controller
{
    public function index ()  {

        return view('admin.promotion.list');
    }


    public function promotionData()
    {
        return DataTables::of(Promotion::get())
        ->addColumn('action', function ($promotion) {
            return '<span class="action-edit" onclick=\'openUpdate('.$promotion.')\'><i class="feather icon-edit"></i></span>
            <a href="'.aurl('delete/promotion/').'/'.$promotion->id.'"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        })
        ->addColumn('status', function ($promotion) {
            $message = '';
            $status = null;
            if( $promotion->date_debut < Carbon::now() &&  Carbon::now() < $promotion->date_fin ) {
                    $status = 1 ;
            }else if(Carbon::now() > $promotion->date_fin) {
                $status = 2;

            }else if($promotion->date_debut > Carbon::now()) {
                $status = 0 ;
            }
            switch ($status) {
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
                            <div class="chip-text">In progress </div>
                        </div>
                    </div>';
                    break;

                case 2:
                    $message = '            <div class="chip chip-danger">
                    <div class="chip-body">
                        <div class="chip-text">Passed</div>
                    </div>
                </div>';
                    break;
            }
            return $message ;
        })

        ->addColumn('gerer', function ($promotion) {
            return '
            <a href="'.aurl('ligne/promotion/').'/'.$promotion->id.'"><span class="action-delete"><i class="feather icon-settings"></i> Gerer Promotion</span></a>';
        })
        ->rawColumns([ 'gerer','status',  'action' ])

        ->make(true);
    }


    public function addPromotion (Request $request) {

        $promotion = new  Promotion() ;


        $promotion->libelle      = $request->libelle;
        $promotion->date_debut   = $request->date_debut;
        $promotion->date_fin     = $request->date_fin;
        $promotion->taux_min      = $request->taux_min;
        $promotion->save();

        return back();
    }

    public function editPromotion  ( Request $request , $id ) {




        $promotion =   Promotion::find($id ) ;

        if($promotion)
        {

            $promotion->libelle      = $request->libelle;
            $promotion->date_debut   = $request->date_debut;
            $promotion->date_fin     = $request->date_fin;
            $promotion->taux_min      = $request->taux_min;

            $promotion->save();
        }




        return back();
    }


    public function remove ($id) {


        $promotion = Promotion::find($id ) ;

        if($promotion)
        {
            $promotion->delete();

        }

        return back();
    }
}
