<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Employe;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index ()  {

        return view('admin.user.list');
    }

    public function userData ()  {
        $data = [];
        $user =  User::get();

        foreach ($user as $key => $value) {
           $value->role = 'user';

           if($value->status == 0) {
            $value->status = "notconfirmed";
           }else if ($value->status == 1) {
            $value->status = "Active";
           }else if ($value->status == 2) {
            $value->status = "Blocked";
           } else if ($value->status == 3) {
            $value->status = "Deactivated";
           }
        }


        $data = array_merge ($data ,  $user->toArray());

        $admin =  Admin::get();

        foreach ($admin as $key => $value) {
           $value->role = 'admin';
           if($value->status == 0) {
            $value->status = "notconfirmed";
           }else if ($value->status == 1) {
            $value->status = "Active";
           }else if ($value->status == 2) {
            $value->status = "Blocked";
           } else if ($value->status == 3) {
            $value->status = "Deactivated";
           }
        }


        $data = array_merge ($data ,  $admin->toArray());


        $employer =  Employe::get();

        foreach ($employer as $key => $value) {
           $value->role = 'Employer';
           if($value->status == 0) {
            $value->status = "notconfirmed";
           }else if ($value->status == 1) {
            $value->status = "Active";
           }else if ($value->status == 2) {
            $value->status = "Blocked";
           } else if ($value->status == 3) {
            $value->status = "Deactivated";
           }
        }


        $data = array_merge ($data ,  $employer->toArray());

        return $data;
    }



    public function remove ($id) {
        $user = null;
        if(request()->role == "user")
            $user = User::find($id ) ;
        if(request()->role == "admin")
           $user = Admin::find($id ) ;
        if(request()->role == "Employer")
           $user = Employe::find($id ) ;
        if($user)
        {
            $user->delete();

            return response('',200);
        }else{

            return response('',404);;
        }

    }

}
