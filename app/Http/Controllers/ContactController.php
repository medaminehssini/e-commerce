<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index ()  {

        $contact = Contact::get();
        return view('admin.contact.list')->with('contacts' , $contact);
    }





    public function addContact (Request $request) {
        $this->validate($request, [

            'message' => 'required',
            'email' => 'required|email',
            'nom' => 'required',
        ]);


        $contact = new  Contact() ;


        
        $contact->id = $request->id;
        $contact->nom = $request->nom;
        $contact->email = $request->email;
        $contact->message = $request->message;


        $contact->save();

        return back();
    }



    public function remove ($id) {


        $contact = Contact::find($id ) ;

        if($contact)
        {
            $contact->delete();

        }

        return back();
    }
}
