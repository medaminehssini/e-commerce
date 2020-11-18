<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Article;
use App\Models\LigneCommande;
use DateTime;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CommandeController extends Controller
{
    public function index ()  {

        return view('admin.commande.list');
    }


    public function CommandeData ()
    {
        return DataTables::of(Commande::with('client' , 'coupon')->get())
        ->addColumn('action', function ($commande) {
            if($commande->etat == 0)
           {
               return ' <a href="'.aurl('accpeter/commande/').'/'.$commande->id.'"><span class="action-delete" style="color: green"><i class="feather icon-check"></i>Accepter</span></a>
            <a href="'.aurl('refuser/commande').'/'.$commande->id.'"><span class="action-delete" style="color: red"><i class="feather icon-x"></i>Refuser</span></a>
            ';
        }else if ($commande->etat == 1) {
            return '
            <a href="'.aurl('refuser/commande').'/'.$commande->id.'"><span class="action-delete" style="color: red"><i class="feather icon-x"></i>Refuser</span></a>
            <a href="'.aurl('accpeter/commande/').'/'.$commande->id.'"><span class="action-delete" style="color: green"><i class="feather icon-check"></i>Delivered</span></a>
            ';
            }else if ($commande->etat == 2){
                return ' <a href="'.aurl('accpeter/commande/').'/'.$commande->id.'"><span class="action-delete" style="color: green"><i class="feather icon-check"></i>Accepter</span></a>

                ';
            }
        })

        ->addColumn('status', function ($commande) {
            switch ($commande->etat) {
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
                            <div class="chip-text">Accepted </div>
                        </div>
                    </div>';
                    break;

                case 2:
                    $message = '            <div class="chip chip-danger">
                    <div class="chip-body">
                        <div class="chip-text">Canceled</div>
                    </div>
                </div>';
                    break;
                case 3:
                    $message = '<div class="chip chip-success">
                    <div class="chip-body">
                        <div class="chip-text">Delivered </div>
                    </div>
                </div>';
                    break;
            }
            return $message ;
        })
        ->addColumn('facture', function ($commande) {

                    $message = '<div class="chip chip-primary">
                            <div class="chip-body">
                                <div class="chip-text"><a style="color:white" href="'.aurl('facture').'/'.$commande->id.'">Get Facture</a></div>
                            </div>
                        </div>';

            return $message ;
        })
        ->addColumn('listProd', function ($commande) {

            $message = '<div style="font-size: 20px; text-align: center;">

                            <i class="feather icon-shopping-bag"></i>

                        </div>';

            return $message ;
        })
        ->addColumn('details', function ($commande) {

            $message = '<div style="font-size: 20px; text-align: center;">

                            <i class="feather icon-plus-circle"></i>

                        </div>';

            return $message ;
        })
        ->rawColumns([ 'action' , "status"  , "facture" , "listProd" , "details"])

        ->make(true);
    }


    public function AccepterCommande ($id) {
        $commande = Commande::find($id);


        if($commande) {
            if($commande->etat == 1)  {
                $commande->etat = 3;
                alert()->success('Commande modifié', '')->toToast();

            }else {
                foreach ($commande->article as $key => $article) {
                    $article->qty -= $article->pivot->qty;
                    $article->save();
                }
                $commande->etat = 1;
                alert()->success('Commande accéptée', '')->toToast();
            }

            $commande->save();


        }



        return back();

    }
    public function refuserCommande ($id) {
        $commande = Commande::find($id);


        if($commande) {
            if( $commande->etat == 1 ) {

                foreach ($commande->article as $key => $article) {
                    $article->qty += $article->pivot->qty;
                    $article->save();
                }
            }

            $commande->etat = 2;
            $commande->save();
        }



        return back();
    }


    public function LigneCommandeData ($id)
    {
        $commande = Commande::find($id);
        if($commande) {
            return DataTables::of($commande->article)
                ->addColumn('photo', function ($article) {
                    $u = url('').'/';
                    return '<img src="'. $u . explode(',',$article->images)[0] .'" alt="Img placeholder">';
                })
                ->rawColumns([ 'photo' , "status" ])
                ->make(true);
         }
    }



}
