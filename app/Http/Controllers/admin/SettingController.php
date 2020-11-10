<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function setting ()  {

        return view('admin.settings.setting');
    }

    public function UpdateSetting (Request $request)  {

        $messages = [
            'name.required' => 'Vous devez ajouter une name',
            'phone.required' => 'Champs phone obligatoire',
            'mail.required' => 'Champs mail obligatoire',
            'adresse.required' => 'Champs adresse obligatoire',
            'currency.required' => 'Champs currency obligatoire',
        ];

        $this->validate($request, [

            'name' => 'required',
            'phone' => 'required',
            'mail' => 'required',
            'adresse' => 'required',
            'currency' => 'required',

        ], $messages);



        $Setting = Setting::where("mot", "name" )->first() ;
        $Setting->description = $request->name;
        $Setting->save();

        $Setting = Setting::where("mot", "phone" )->first() ;
        $Setting->description = $request->phone;
        $Setting->save();

        $Setting = Setting::where("mot", "mail" )->first() ;
        $Setting->description = $request->mail;
        $Setting->save();

        $Setting = Setting::where("mot", "adresse" )->first() ;
        $Setting->description = $request->adresse;
        $Setting->save();

        $Setting = Setting::where("mot", "currency" )->first() ;
        $Setting->description = $request->currency;
        $Setting->save();


        $Setting = Setting::where("mot", "facebook" )->first() ;
        $Setting->description = $request->facebook;
        $Setting->save();

        $Setting = Setting::where("mot", "twitter" )->first() ;
        $Setting->description = $request->twitter;
        $Setting->save();

        $Setting = Setting::where("mot", "googleplus" )->first() ;
        $Setting->description = $request->googleplus;
        $Setting->save();

        $Setting = Setting::where("mot", "youtube" )->first() ;
        $Setting->description = $request->youtube;
        $Setting->save();

        $Setting = Setting::where("mot", "instagrame" )->first() ;
        $Setting->description = $request->instagrame;
        $Setting->save();


        alert()->success('Parametre bien modifiee', '')->toToast();

        return back();
    }

}
