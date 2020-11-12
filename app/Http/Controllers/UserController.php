<?php

namespace App\Http\Controllers;

use App\Mail\RestPassword;
use App\Mail\VerifyMail;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        'password.required' => 'Mot de passe obligatoire',
        'confirmation_password.required' => 'Confirmation obligatoire',
        'password.same' => 'Mot de passe invalide',
        'confirmation_password.same' => 'Mot de passe invalide',
        'username.required' => 'Nom d\'utilisateur obligatoire',
        'first_name.required' => 'Prénom  obligatoire',
        'last_name.required' => 'Nom obligatoire',
        'email.required' => 'Email obligatoire',
        'email.email' => 'Adresse email invalide',
        'email.unique' => 'Adresse email deja utilisée',


    ];

    $this->validate($request, [
        'password' => 'required|same:password',
        'confirmation_password' => 'required|same:password',
        'username' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:client',
    ], $messages);



        $user = new User();
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->save();
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);
        Mail::to($user->email)->send(new VerifyMail($user));
        alert()->success('Compte crée avec succès', '')->toToast();
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
            if (!Auth::user()->status) {
                Auth::logout();
                alert()->error('You need to confirm your account. We have sent you an activation code, please check your email.')->toToast();
                return back();
            }
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

            alert()->success('Adresse modifiée avec succès', '')->toToast();


        }
        return back();
    }

    public function logout () {

        Auth::logout();
        return redirect(url('login'));
    }

    public function verifyUser($token)
    {
      $verifyUser = VerifyUser::where('token', $token)->first();
      if(isset($verifyUser) ){
        $user = $verifyUser->user;
        if(!$user->status) {
          $verifyUser->user->status = 1;
          $verifyUser->user->save();
          $verifyUser->delete();
          $status = "Your e-mail is verified. You can now login.";
        } else {
          $status = "Your e-mail is already verified. You can now login.";
        }
      } else {
        alert()->error( "Sorry your email cannot be identified.")->toToast();
        return redirect()->route('login');
      }
      alert()->success( $status)->toToast();
      return redirect()->route('login');
    }





    public function restPassword()
    {
        return view('boutique.resetPassword');
    }


    public function restPasswordNow(Request $request)
    {
        $user = User::where("email", $request->email)->first();
        if($user) {
            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time()),
                'rest'=>1,
            ]);
            Mail::to($user->email)->send(new RestPassword($user));
            alert()->success("Mail " )->toToast();
        }else{
            alert()->error( "Sorry your email cannot be identified.")->toToast();
        }

        return back();

    }

    public function RestPasswordUser($token)
    {
      $verifyUser = VerifyUser::where(['token'=> $token , 'rest' => 1])->first();
      if(isset($verifyUser) ){
        $user = $verifyUser->user;
        return view('boutique.resetPasswordNow');
      } else {
        alert()->error( "Sorry invalid Url.")->toToast();
        return redirect()->route('login');
      }
      return redirect()->route('login');
    }

    public function RestPasswordUserNow(Request $request , $token)
    {

        $messages = [
            'password.required' => 'Mot de passe obligatoire',
            'password_confirmation.required' => 'Confirmation obligatoire',
            'password.same' => 'Mot de passe invalide',
            'password_confirmation.same' => 'Mot de passe invalide',
        ];

        $this->validate($request, [
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',

        ], $messages);


      $verifyUser = VerifyUser::where(['token'=> $token , 'rest' => 1])->first();
      if(isset($verifyUser) ){
        $user = $verifyUser->user;
        $user->password = Hash::make($request->password);
        $user->save();
        alert()->success( "Password changed.")->toToast();
      } else {
        alert()->error( "Sorry your email cannot be identified.")->toToast();
        return redirect()->route('login');
      }
      return redirect()->route('login');
    }

}
