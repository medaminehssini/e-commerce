<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Hash;
use Validator;
class AdminController extends Controller
{
    public function  login (Request $request) {

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/admin');

        }else {
            return back();
        }
    }


    public function editProfile () {

        return view('admin.profile.edit.profile');
    }




    public function editProfileNow (Request $request) {

            $nameImage = null;
            if($request->hasfile('image'))
            {
                $messages = [
                    'image.mimes' => 'Choisir une photo de profil',
                ];
                $this->validate($request, [

                    'image' => 'mimes:jpg,jpeg,png,gif'
                ], $messages);


                $name = time().'.'.$request->image->extension();
                $request->image->move(public_path().'/uploads/img/admin', $name);
                $nameImage = '/uploads/img/admin/'.$name;

            }
            $user = Admin::find(Auth::guard('admin')->user()->id);
            if ($nameImage) $user->image      = $nameImage;
            $user->first_name =  $request->first_name;

            $user->last_name =  $request->last_name;
            $user->username =  $request->username;
            $user->save();

        alert()->success('Profil bien modifié', '')->toToast();
        return back();
    }

    public function editPassword (Request $request) {
            $messages = [
                'current_password.required' => 'Entrer votre mot de passe actuel',
                'password.required' => 'Taper la nouvelle mot de passe ',
                'confirmation_password.required' => 'Re-taper la nouvelle mot de passe ',
                
            ];

            $this->validate($request, [
                'current_password' => 'required',
                'password' => 'required|same:password',
                'confirmation_password' => 'required|same:password',
            ], $messages);


            if(Hash::check($request->current_password, Auth::guard('admin')->user()->password))
            {
                $user = Admin::find(Auth::guard('admin')->user()->id);
                $user->password =  Hash::make($request->password);
                $user->save();
                alert()->success('Profil bien modifié', '')->toToast();

            }else {
                alert()->error('Mot de passe actuelle non valide !', 'Error')->toToast();

            }



        return back();
    }



    public function logout () {

        Auth::guard('admin')->logout();
        return redirect(aurl('login'));
    }
}
