<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
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



}
