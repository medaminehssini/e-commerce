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
        ->addColumn('publish', function ($contact) {
             if ($contact->publish_state == 1) {
                return '
                <a href="'.aurl('contact/publish').'/'.$contact->id.'"><span class="action-delete" style="color: red"><i class="feather icon-x"></i>supprimer</span></a>
                ';
            }else if ($contact->publish_state == 0){
                return ' <a href="'.aurl('contact/publish').'/'.$contact->id.'"><span class="action-delete" style="color: green"><i class="feather icon-check"></i>Publier</span></a>

                ';
            }
        })
        ->rawColumns([ 'publish'  ])

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


    public function publish( $id )
    {
        $contact = Contact::find($id) ;
        if($contact) {

            $contact->publish_state = $contact->publish_state == 0 ? 1 : 0 ;
            $contact->save();
            if($contact->publish_state == 1) {
                alert()->success('Message Publier', '')->toToast();
            }
            else
            {
                alert()->success('Message modifiée', '')->toToast();
            }
        }else {
            alert()->error('Cette message n\'existe pas ', '')->toToast();

        }
        return back();
    }

}
