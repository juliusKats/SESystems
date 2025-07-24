<?php
namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\CardMinistries;
use App\Models\ServiceScheme;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class SchemeController extends Controller
{

    //Action Dialog
    public function DeteteDialog(Request $request,$id){
        $file=ServiceScheme::findOrFail($id);
        return view('FileManager.SCHEMES.Actions.Delete',compact('file'));
    }
    public function PerDeteteDialog(Request $request,$id){
        $file=ServiceScheme::findOrFail($id);
        return view('FileManager.SCHEMES.Actions.PerDelete',compact('file'));
    }
    public function RestoreDialog(Request $request,$id){
        $file=ServiceScheme::findOrFail($id);
        return view('FileManager.SCHEMES.Actions.Restore',compact('file'));
    }
    public function RejectDialog(Request $request,$id){
        $file=ServiceScheme::findOrFail($id);
        return view('FileManager.SCHEMES.Actions.Reject',compact('file'));
    }
    public function ApproveDialog(Request $request,$id){
        $file=ServiceScheme::findOrFail($id);
        return view('FileManager.SCHEMES.Actions.Approve',compact('file'));
    }
    public function index()
    {

        $allactives =  ServiceScheme::select('service_schemes.id', 'service_schemes.CarderName', 'service_schemes.ext', 'service_schemes.comment as VComment', 'service_schemes.status', 'service_schemes.WordFile as EXCEL', 'service_schemes.PDFFile as PDF', 'service_schemes.ApprovedOn as PSDate', 'service_schemes.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'service_schemes.UploadedBy', 'service_schemes.ApprovedBy as UpprovedBy', 'service_schemes.UploadedOn as UploadDate', 'service_schemes.created_at', 'service_schemes.updated_at as UpdateDate', 'service_schemes.UpdatedBy', 'service_schemes.DeletedBy', 'service_schemes.RestoredBy')
            ->join('users', 'users.id', '=', 'service_schemes.UploadedBy')
            ->where('service_schemes.status', 3)
            ->orderBy("created_at", "desc")->get();
            $allpending =  ServiceScheme::select('service_schemes.id', 'service_schemes.CarderName', 'service_schemes.ext', 'service_schemes.comment as VComment', 'service_schemes.status', 'service_schemes.WordFile as EXCEL', 'service_schemes.PDFFile as PDF', 'service_schemes.ApprovedOn as PSDate', 'service_schemes.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'service_schemes.UploadedBy', 'service_schemes.ApprovedBy as UpprovedBy', 'service_schemes.UploadedOn as UploadDate', 'service_schemes.created_at', 'service_schemes.updated_at as UpdateDate', 'service_schemes.UpdatedBy', 'service_schemes.DeletedBy', 'service_schemes.RestoredBy')
            ->join('users', 'users.id', '=', 'service_schemes.UploadedBy')
            ->where('service_schemes.status', 2)
            ->orderBy("created_at", "desc")->get();
        $allrejected =  ServiceScheme::select('service_schemes.id', 'service_schemes.CarderName', 'service_schemes.ext', 'service_schemes.comment as VComment', 'service_schemes.status', 'service_schemes.WordFile as EXCEL', 'service_schemes.PDFFile as PDF', 'service_schemes.ApprovedOn as PSDate', 'service_schemes.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'service_schemes.UploadedBy', 'service_schemes.ApprovedBy as UpprovedBy', 'service_schemes.UploadedOn as UploadDate', 'service_schemes.created_at', 'service_schemes.updated_at as UpdateDate', 'service_schemes.UpdatedBy', 'service_schemes.DeletedBy', 'service_schemes.RestoredBy')
            ->join('users', 'users.id', '=', 'service_schemes.UploadedBy')
            ->where('service_schemes.status', 4)
            ->orderBy("created_at", "desc")->get();
        $alldeleted =  ServiceScheme::onlyTrashed()->select('service_schemes.id', 'service_schemes.CarderName', 'service_schemes.ext', 'service_schemes.comment as VComment', 'service_schemes.status', 'service_schemes.WordFile as EXCEL', 'service_schemes.PDFFile as PDF', 'service_schemes.ApprovedOn as PSDate', 'service_schemes.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'service_schemes.UploadedBy', 'service_schemes.ApprovedBy as UpprovedBy', 'service_schemes.UploadedOn as UploadDate', 'service_schemes.created_at', 'service_schemes.updated_at as UpdateDate', 'service_schemes.UpdatedBy', 'service_schemes.DeletedBy', 'service_schemes.RestoredBy')
            ->join('users', 'users.id', '=', 'service_schemes.UploadedBy')
            ->where('service_schemes.status', 5)
            ->orderBy("created_at", "desc")->get();

        $mypending =  ServiceScheme::select('service_schemes.id', 'service_schemes.CarderName', 'service_schemes.ext', 'service_schemes.comment as VComment', 'service_schemes.status', 'service_schemes.WordFile as EXCEL', 'service_schemes.PDFFile as PDF', 'service_schemes.ApprovedOn as PSDate', 'service_schemes.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'service_schemes.UploadedBy', 'service_schemes.ApprovedBy as UpprovedBy', 'service_schemes.UploadedOn as UploadDate', 'service_schemes.created_at', 'service_schemes.updated_at as UpdateDate', 'service_schemes.UpdatedBy', 'service_schemes.DeletedBy', 'service_schemes.RestoredBy')
            ->join('users', 'users.id', '=', 'service_schemes.UploadedBy')
            ->where('service_schemes.status', 2)
            ->where('service_schemes.UploadedBy', Auth::user()->id)
            ->orderBy("created_at", "desc")->get();
        $myrejected =  ServiceScheme::select('service_schemes.id', 'service_schemes.CarderName', 'service_schemes.ext', 'service_schemes.comment as VComment', 'service_schemes.status', 'service_schemes.WordFile as EXCEL', 'service_schemes.PDFFile as PDF', 'service_schemes.ApprovedOn as PSDate', 'service_schemes.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'service_schemes.UploadedBy', 'service_schemes.ApprovedBy as UpprovedBy', 'service_schemes.UploadedOn as UploadDate', 'service_schemes.created_at', 'service_schemes.updated_at as UpdateDate', 'service_schemes.UpdatedBy', 'service_schemes.DeletedBy', 'service_schemes.RestoredBy')
            ->join('users', 'users.id', '=', 'service_schemes.UploadedBy')
            ->where('service_schemes.UploadedBy', Auth::user()->id)
            ->where('service_schemes.status', 4)
            ->orderBy("created_at", "desc")->get();
        $mydeleted =  ServiceScheme::onlyTrashed()->select('service_schemes.id', 'service_schemes.CarderName', 'service_schemes.ext', 'service_schemes.comment as VComment', 'service_schemes.status', 'service_schemes.WordFile as EXCEL', 'service_schemes.PDFFile as PDF', 'service_schemes.ApprovedOn as PSDate', 'service_schemes.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'service_schemes.UploadedBy', 'service_schemes.ApprovedBy as UpprovedBy', 'service_schemes.UploadedOn as UploadDate', 'service_schemes.created_at', 'service_schemes.updated_at as UpdateDate', 'service_schemes.UpdatedBy', 'service_schemes.DeletedBy', 'service_schemes.RestoredBy')
            ->join('users', 'users.id', '=', 'service_schemes.UploadedBy')
            ->where('service_schemes.UploadedBy', Auth::user()->id)
            ->where('service_schemes.status', 5)
            ->orderBy("created_at", "desc")->get();

        return view("FileManager.SCHEMES.index",
            compact("allactives", 'allpending', 'allrejected', 'alldeleted', 'mypending', 'myrejected', 'mydeleted'));
        // return view("FileManager.SCHEMES.index", compact('services'));
    }

    public function create()

    {
        // dd("i am");
         $carders = CardMinistries::all();
        return view("FileManager.Schemes.add",compact('carders'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin') {
            $status = 3;
        } else {
            $status = 2;
        }
        $year  = date("Y");
        $month = date("M");
        $date  = Carbon::now();
        $datef = $date->format("d_M_Y_") . time() . "_";

        $schemePS   = 'Scheme/' . $year . "/" . $month . "/PDF";
        $schemeWord = 'Scheme/' . $year . "/" . $month . "/DOCS";

        $data = $request->validate([
            'ministry'       => 'required|exists:card_ministries,id',
            'cardername'   => 'required',
            'approvaldate' => 'required|date|before:today',
            'comment'      => 'nullable|string',
            'fileupload'   => 'required',
            'fileupload.*'   => 'required|mimes:pdf,docx,doc',
            'pdf'          => 'required',
            'pdf.*'          => 'mimes:pdf',
        ]);
          $carderID=[];
         $cardes =$request->cardername;
        foreach ($cardes as $key => $value) {
            $carderArray[]=$value;
        }
        $carderID=implode(",",$carderArray);

        // validate comment
        $dom = new \DomDocument();
        $dom->loadHTML($request->comment, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('imageFile');
        foreach ($imageFile as $item => $image) {

            $data              = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData          = base64_decode($data);
            $image_name        = "/upload/" . time() . $item . '.png';
            $path              = public_path() . $image_name;
            file_put_contents($path, $imgeData);
            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);

        }
        $schemecomment = $dom->saveHTML();

        if ($request->file('fileupload') != null) {
            $fileupload     = $request->file('fileupload')->getClientOriginalName();
            $fileuploadsize = $request->file('fileupload')->getSize();
        }
        if ($request->file('pdf') != null) {
            $PSfilename = $request->file('pdf')->getClientOriginalName();
            $PSsize     = $request->file('pdf')->getSize();
        }


        $foldermonth = $year . "/" . $month;
        $pdf         = "PSPDF";
        $jdpdf       = "SCHEMEPDF";
        $jddoc       = "SCHEMEDOC";
        $pspdfpath   = "Schemes/" . $year . "/" . $month . "/" . $pdf;
        $jdpdfpath   = "Schemes/" . $year . "/" . $month . "/" . $jdpdf;
        $jddocpath   = "Schemes/" . $year . "/" . $month . "/" . $jddoc;

         $date = Carbon::now();
        $date = $date->format("D_d_M_Y_") . time() . "_";




        // dd($documentArray);
         $date = Carbon::now();
        $date = $date->format("D_d_M_Y_") . time() . "_";
        if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            $pspdffile = $request->file("pdf");
            $poriginal = $pspdffile->getClientOriginalName();
            $pspdfname = $date . $poriginal;
            $epath1    = $pspdffile->move(public_path('storage/' . $pspdfpath), $pspdfname);
        }
        if ($request->hasFile('fileupload') && $request->file('fileupload')->isValid()) {
            $uploadfile = $request->file("fileupload");
            $ext        = $uploadfile->getClientOriginalExtension();
            if ($ext == "pdf") {
                $fileuploadoriginal = $uploadfile->getClientOriginalName();
                $pdfname            = $date . $fileuploadoriginal;
                $epath2             = $uploadfile->move(public_path('storage/' . $jdpdfpath), $pdfname);
            } else {
                $fileuploadoriginal = $uploadfile->getClientOriginalName();
                $pdfname            = $date . $fileuploadoriginal;
                $epath2             = $uploadfile->move(public_path('storage/' . $jddocpath), $pdfname);
            }
        }
        $scheme = ServiceScheme::create([
           'carder_id'=>$request->ministry,
             'CarderName'     => $carderID,
            'WordFile'       => $pdfname,
            'ext'            => $ext,
            'PDFFile'=>$pdfname,
            'status'=>$status,
            'ApprovedOn'=>$request->approvaldate,
            'comment'=>$schemecomment,
            'UploadedBy'=>Auth::user()->id,
        ]);

        if($scheme){
            return redirect()->route('scheme.service.list')->with('success','Scheme Of Service Document Uploaded Successfuly');
        }
        if($scheme){
            return back()->with('error','Scheme Of Service Document Failed to Upload');
        }
    }
    public function SoftDelete(Request $request, $id)
    {
        $file             = ServiceScheme::find($id);
        $file->status     = 5;
        $file->DeletedBy  = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;
        $file->RestoredBy = null;
        $file->save();
        $file->delete();
        return redirect()->route('scheme.service.list')->with('success', 'File moved to Bin successfully');
    }
    public function Restore($id)
    {
        $vote = ServiceScheme::withTrashed()->findOrFail($id);
        $vote->restore();
        $vote->status     = 2;
        $vote->DeletedBy  = null;
        $vote->RestoredBy = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;
        $vote->save();
        return redirect()->route('scheme.service.list')->with('success', 'File Restored successfully');
    }
    public function deleteVote(Request $request, $id)
    {
        // withTrashed()->findOrFail($id)
        $userfile = ServiceScheme::withTrashed()->findOrFail($id);
        $pdf      = $userfile->pdffile;
        $excel    = $userfile->excelfile;
        if ($pdf) {
            $pdfyear  = explode('_', $pdf)[3];
            $pdfmonth = explode('_', $pdf)[2];
            $pdfpath  = "J0bs/" . $pdfyear . "/" . $pdfmonth . "/PSPDF/" . $pdf;
            $pdfexist = File::delete(public_path('storage/' . $pdfpath));
            if ($pdfexist) {
                File::delete(public_path('storage/' . $pdfpath));
            }
        }
        if ($excel) {
            $excelyear  = explode('_', $excel)[3];
            $excelmonth = explode('_', $excel)[2];
            $excelpath  = "Votes/" . $excelyear . "/" . $excelmonth . "/EXCEL/" . $excel;
            $excelexist = File::delete(public_path('storage/' . $excelpath));
            if ($excelexist) {
                File::delete(public_path('storage/' . $excelpath));
            }
        }

        $userfile->forceDelete();
        return redirect()->route('scheme.service.list')->with('success', 'All Files Deleted Successfully');

    }

       public function ApproveFile(Request $request, $id)
    {
        $file   = ServiceScheme::find($id);
        $status = $file->status;
        if ($status == 3) {
            $file->status      = 2;
            $file->DateOn      = null;
            $file->ApprovedBy  = null;
            $file->approved_by = null;
            $file->DateOn      = null;
            $file->RejectedBy  = null;
            $file->Reason      = null;
            $file->updated_at  = Carbon::now();
            $file->save();
            return redirect()->route('scheme.service.list')->with('success', 'file De-activated');
        } else {
            $file->status      = 3;
            $file->DateOn      = Carbon::now();
            $file->updated_at  = Carbon::now();
            $file->ApprovedBy  = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;
            $file->approved_by = Auth::user()->id;
            $file->DateOn      = null;
            $file->RejectedBy  = null;
            $file->Reason      = null;
            $file->save();
            return redirect()->route('scheme.service.list')->with('success', 'Vote Activated');
        }
    }

       public function RejectFile(Request $request, $id)
    {
        $file = ServiceScheme::
        select('job_documents.id', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy','card_ministries.carderName as ministry')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->join('doc_statuses','doc_statuses.id','=','job_documents.status')
           ->join('card_ministries','card_ministries.id','=','job_documents.carder_id')
            ->where('job_documents.id','=', $id)->first(); // Master Query
        // dd($file);
        return view('FileManager.Schemes.RejectScheme', compact('file'));

    }
public function RejectSave(Request $request, $id)
    {
        $file = ServiceScheme::find($id);
        $request->validate([
            'reason' => 'required|string|min:10',
        ]);
        $reason = $request->comment;
        $dom    = new \DomDocument();
        $dom->loadHTML($request->reason, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('imageFile');
        foreach ($imageFile as $item => $image) {
            $data              = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData          = base64_decode($data);
            $image_name        = "/upload/" . time() . $item . '.png';
            $path              = public_path() . $image_name;
            file_put_contents($path, $imgeData);
            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);

        }
        $reason = $dom->saveHTML();

        $file->status     = 4;
        $file->DateOn     = Carbon::now();
        $file->updated_at = Carbon::now();
        $file->RejectedBy = Auth::user()->id;
        $file->Reason     = $reason;
        $final            = $file->save();
        if ($final) {
            return redirect()->route('scheme.service.list')->with('success', 'Rejection Reason Successfully added');
        } else {
            return redirect()->route('scheme.file.reject', $id)->with('error', 'Something Went Wrong');
        }

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}



