<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index () {
        return view('boutique.contact.contact');
    }
    public function store (Request $request) {
        $contact = new  Contact() ;


        $contact->nom = $request->nom;
        $contact->message      = $request->message;
        $contact->email         = $request->email;




        $contact->save();
        alert()->success('Message bien Envoyée', '')->toToast();

        return back();
    }
}
