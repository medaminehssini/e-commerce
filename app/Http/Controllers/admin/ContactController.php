<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Setting;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index ()  {

        return view('admin.contact.list');
    }

    public function contactData ()
    {
        return DataTables::of(Contact::get())



        ->make(true);
    }

    public function setting ()  {

        return view('admin.contact.setting');
    }

    public function UpdateSetting (Request $request)  {

        $messages = [
            'description.required' => 'Vous devez ajouter une description',
            'longitude.required' => 'Champs longitude obligatoire',
            'latitude.required' => 'Champs latitude obligatoire',
        ];

        $this->validate($request, [

            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',

        ], $messages);



        $Setting = Setting::where("mot", "contact_description" )->first() ;
        $Setting->description = $request->description;
        $Setting->save();

        $Setting = Setting::where("mot", "longitude" )->first() ;
        $Setting->description = $request->longitude;
        $Setting->save();

        $Setting = Setting::where("mot", "latitude" )->first() ;
        $Setting->description = $request->latitude;
        $Setting->save();



        alert()->success('Parametre bien modifiee', '')->toToast();

        return back();
    }

}
