<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function register  () {
       if(!Auth::check())
        return view("boutique.signup");
       else
        return redirect('');
   }

   public function registerNow (Request $request) {
    $messages = [
        'password.required' => 'Champs obligatoire',
        'confirmation_password.required' => 'Champs obligatoire',
        'password.same' => 'Mot de passe invalide',
        'confirmation_password.same' => 'Mot de passe invalide',

    ];

    $this->validate($request, [
        'password' => 'required|same:password',
        'confirmation_password' => 'required|same:password',
    ], $messages);



        $user = new User();
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->save();
        alert()->success('register  ', 'Successfully')->toToast();
        return redirect('/login');
}

    public function  login ( ) {

        if(!Auth::check())
            return view("boutique.login");
        else
            return redirect('');
    }


    public function  loginNow (Request $request) {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password ], $request->remember)) {
            return redirect('/');

        }else {
            alert()->error('Verifier votre mot de passe ou email  ')->toToast();
            return back();
        }
    }


    public function  account ( ) {
        $commandes =  User::find(Auth::user()->id)->commande;
        foreach ($commandes as $key => $commande) {
            switch ($commande->etat) {
                case 0:

                    $commande->status = "pending";
                    break;
                case 1:
                    $commande->status = "Accepted";
                    break;

                case 2:
                     $commande->status = "Canceled";
                    break;

                case 3:
                   $commande->status = "Delivered";
                   break;
            }
        }
        return view("boutique.user.myaccount")->with('commandes' , $commandes);

    }
    public function  accountNow (Request $request) {
        $verif = true ;
        $nameImage = null;
        if($request->hasfile('image'))
        {
            $this->validate($request, [

                'image' => 'mimes:jpg,jpeg,png,gif'
            ]);


            $name = time().'.'.$request->image->extension();
            $request->image->move(public_path().'/boutique/uploads/img/user', $name);
            $nameImage = '/boutique/uploads/img/user/'.$name;

        }
        $user = User::find(Auth::user()->id);
        if($user) {
            if($nameImage) $user->image = $nameImage;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->sexe = $request->sexe;

            if( $request->current_password != '') {
                $messages = [
                    'password.required' => 'Champs obligatoire',
                    'confirmation_password.required' => 'Champs obligatoire',
                    'password.same' => 'Mot de passe invalide',
                    'confirmation_password.same' => 'Mot de passe invalide',

                ];
                $this->validate($request, [
                    'password' => 'required|same:password',
                    'confirmation_password' => 'required|same:password',
                ], $messages);

                if(Hash::check($request->current_password, Auth::user()->password))
                {
                    $user->password =  Hash::make($request->password);

                }else {
                    alert()->error('current password invalid', 'Error')->toToast();
                    $verif = false ;
                }

            }

            $user->save();
            if( $verif)
            alert()->success('Profile Edited', 'Successfully')->toToast();


        }
        return back();
    }


    public function  adresse (Request $request) {

        $user = User::find(Auth::user()->id);
        if($user) {
            $user->adresse = $request->adresse;
            $user->ville = $request->ville;
            $user->code_postale = $request->code_postale;

            $user->save();

            alert()->success('adresse Edited', 'Successfully')->toToast();


        }
        return back();
    }

    public function logout () {

        Auth::logout();
        return redirect(url('login'));
    }


}
