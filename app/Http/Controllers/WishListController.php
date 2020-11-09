<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index()
    {
        $wishs = User::find(Auth::user()->id);
        return view('boutique.wishlist.wishlist')->with('wishs',$wishs->wishList);
    }

    public function add($id)
    {        $user = User::find(Auth::user()->id);

        if($user) {
            $user->wishList()->detach($id);
            $user->wishList()->attach($id );
            alert()->success('Article bien ajouté au favoris', '')->toToast();

        }else
            abort(404);

        return back();
    }

    public function remove($id)
    {
        $user = User::find(Auth::user()->id);
        if($user) {
            $user->wishList()->detach($id);
            alert()->success('Article bien supprimé des favoris', '')->toToast();
        }else
            abort(404);

            return back();
    }

}
