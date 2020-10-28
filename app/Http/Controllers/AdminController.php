<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class AdminController extends Controller
{
    public function  login (Request $request) {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/admin');

        }else {
            return back();
        }
    }








    public function logout () {

        Auth::logout();
        return redirect(aurl('login'));
    }
}
