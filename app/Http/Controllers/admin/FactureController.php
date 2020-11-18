<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;

class FactureController extends Controller
{
   public function index( $id )
   {
       $commande = Commande::find($id );
       if($commande){

            return view('admin.facture.get')->with('commande' , $commande);

        }else
            abort(404);

   }
}
