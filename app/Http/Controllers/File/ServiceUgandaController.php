<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\ServiceUgandaCenter;
use Illuminate\Http\Request;

class ServiceUgandaController extends Controller
{
    //

    //Action Dialog
    public function DeteteDialog(Request $request,$id){
        $file=ServiceUgandaCenter::findOrFail($id);
        return view('FileManager.ServiceUg.Actions.Delete',compact('file'));
    }
    public function PerDeteteDialog(Request $request,$id){
        $file=ServiceUgandaCenter::findOrFail($id);
        return view('FileManager.ServiceUg.Actions.PerDelete',compact('file'));
    }
    public function RestoreDialog(Request $request,$id){
        $file=ServiceUgandaCenter::findOrFail($id);
        return view('FileManager.ServiceUg.Actions.Restore',compact('file'));
    }
    public function RejectDialog(Request $request,$id){
        $file=ServiceUgandaCenter::findOrFail($id);
        return view('FileManager.ServiceUg.Actions.Reject',compact('file'));
    }
    public function ApproveDialog(Request $request,$id){
        $file=ServiceUgandaCenter::findOrFail($id);
        return view('FileManager.ServiceUg.Actions.Approve',compact('file'));
    }
}
