<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactAdminMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
//use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    //

    public function index() {
        return view('contact.index');
    }

    function sendMail(ContactRequest $request) {
        $validated = $request->validated();

        Mail::to('user@example.com')->send(new ContactAdminMail($validated));
        return redirect()->route('contact.complete');
    }


    public function complete() {
        return view('contact.complete');
    }
}
