<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductivityController extends Controller
{
    //
    public function index(){
        return view('FileManager.Productivity.index');
    }
}
