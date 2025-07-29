<?php
namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\CardMinistries;
use App\Models\JobDocuments;
use App\Models\Version;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class JobDescriptionController extends Controller
{
    public function index()
    {
        //
        $allactives = JobDocuments::select('job_documents.id', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->where('job_documents.status', 3)
            ->orderBy("created_at", "desc")->get(); // Master Query
        $allpending = JobDocuments::select('job_documents.id', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->where('job_documents.status', 2)
            ->orderBy("created_at", "desc")->get();
        $allrejected = JobDocuments::select('job_documents.id', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->where('job_documents.status', 4)
            ->orderBy("created_at", "desc")->get();
        $alldeleted = JobDocuments::onlyTrashed()->select('job_documents.id', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->where('job_documents.status', 5)
            ->orderBy("created_at", "desc")->get();

        $mypending = JobDocuments::select('job_documents.id', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->where('job_documents.status', 2)
            ->where('job_documents.UploadedBy', Auth::user()->id)
            ->orderBy("created_at", "desc")->get();
        $myrejected = JobDocuments::select('job_documents.id', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->where('job_documents.UploadedBy', Auth::user()->id)
            ->where('job_documents.status', 4)
            ->orderBy("created_at", "desc")->get();
        $mydeleted = JobDocuments::onlyTrashed()->select('job_documents.id', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->where('job_documents.UploadedBy', Auth::user()->id)
            ->where('job_documents.status', 5)
            ->orderBy("created_at", "desc")->get();

        return view("FileManager.JOBS.index",
            compact("allactives", 'allpending', 'allrejected', 'alldeleted', 'mypending', 'myrejected', 'mydeleted'));
    }

    public function create()
    {
        $carders = CardMinistries::all();
        $versions=Version::all();
        return view("FileManager.JOBS.add", compact('carders','versions'));
    }

    public function store(Request $request)
    {
// dd($request->all());
        $year  = date("Y");
        $month = date("M");
        $data  = $request->validate([
            'ministry'     => 'required|exists:card_ministries,id',
            'cardername'   => 'required',
            'approvaldate' => 'required|date|before:today',
            'comment'      => 'required|string|min:3',
            'fileupload'   => 'required',
            'fileupload.*' => 'mimes:doc,docx|max:4096',
            'pdf'          => 'required',
            'pdf.*'        => 'mimes:pdf|max:4096',
            'version'=>'required|exists:versions,id'

        ]);

        $carderID = [];
        $cardes   = $request->cardername;
        foreach ($cardes as $key => $value) {
            $carderArray[] = $value;
        }
        $carderID = implode(",", $carderArray);

        $votecomment = $request->comment;
        $dom         = new \DomDocument();
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
        $votecomment = $dom->saveHTML();

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
        $jdpdf       = "JDPDF";
        $jddoc       = "JDDOC";
        $pspdfpath   = "Jobs/" . $year . "/" . $month . "/" . $pdf;
        $jdpdfpath   = "Jobs/" . $year . "/" . $month . "/" . $jdpdf;
        $jddocpath   = "Jobs/" . $year . "/" . $month . "/" . $jddoc;

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

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin') {
            $status = 3;
        } else {
            $status = 2;
        }
        // dd($status);
        //Check if document witht the same version exists
        $exists = JobDocuments::where('carderId',$request->ministry)->where('versionId',$request->version)->exists();
        if($exists){
            return redirect()->route('job.file.create')->with('warning','A version With the same version already exists');
        }
        else{
            $job = JobDocuments::create([
                'carderId'  => $request->ministry,
                'CarderName' => $carderID,
                'WordFile'   => $pdfname,
                'ext'        => $ext,
                'PDFFile'    => $pspdfname,
                'status'     => $status,
                'ApprovedOn' => $request->approvaldate,
                'comment'    => $votecomment,
                'UploadedBy' => Auth::user()->id,
                'versionId'  => $request->version,
            ]);
        }

        if ($job) {
            return redirect()->route('job.file.list')->with('success', 'File Uploaded Successfully');
        } else {
            return redirect()->route('job.file.list')->with('error', 'File Uploaded Failed');
        }
    }

    public function SoftDelete(Request $request, $id)
    {
        $file             = JobDocuments::find($id);
        $file->status     = 5;
        $file->DeletedBy  = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;
        $file->RestoredBy = null;
        $file->save();
        $file->delete();
        return redirect()->route('job.file.list')->with('success', 'File moved to Bin successfully');
    }
    public function Restore($id)
    {
        $vote = JobDocuments::withTrashed()->findOrFail($id);
        $vote->restore();
        $vote->status     = 2;
        $vote->DeletedBy  = null;
        $vote->RestoredBy = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;
        $vote->save();
        return redirect()->route('job.file.list')->with('success', 'File Restored successfully');

    }
    public function deleteVote(Request $request, $id)
    {
        // withTrashed()->findOrFail($id)
        $userfile = JobDocuments::withTrashed()->findOrFail($id);
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
        return redirect()->route('job.file.list')->with('success', 'All Files Deleted Successfully');

    }

    public function ApproveFile(Request $request, $id)
    {
        $file   = JobDocuments::find($id);
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
            return redirect()->route('job.file.list')->with('success', 'file De-activated');
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
            return redirect()->route('job.file.list')->with('success', 'Vote Activated');
        }
    }

    public function RejectFile(Request $request, $id)
    {
        $file = JobDocuments::
            select('job_documents.id', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy', 'card_ministries.carderName as ministry')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'job_documents.status')
            ->join('card_ministries', 'card_ministries.id', '=', 'job_documents.carder_id')
            ->where('job_documents.id', '=', $id)->first(); // Master Query
                                                        // dd($file);
        return view('FileManager.Jobs.RejectJob', compact('file'));

    }
    public function RejectSave(Request $request, $id)
    {
        $file = JobDocuments::find($id);
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
            return redirect()->route('job.file.list')->with('success', 'Rejection Reason Successfully added');
        } else {
            return redirect()->route('job.file.reject', $id)->with('error', 'Something Went Wrong');
        }

    }

    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

}
