<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function MailInbox (Request $request){
        return view('FileManager.EMAIL.mailbox');
    }
   public function  MailCompose (Request $request){
        return view('FileManager.EMAIL.compose');
    }
   public function  MailRead(Request $request){
        return view('FileManager.EMAIL.read');
    }
}
