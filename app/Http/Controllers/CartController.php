<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        Cart::add($request->id ,$request->libelle , $request->qty, $request->prix);
    }
}
