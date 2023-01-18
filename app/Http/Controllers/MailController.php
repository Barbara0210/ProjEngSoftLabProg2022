<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\email;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class MailController extends Controller {
    public function sendMail() {
 
        //$user = User::find(Auth::user()->name);
        Mail::to('fake@mail.com')->send(new email(Auth::user()->name));

        return view('/home');
    }
}
