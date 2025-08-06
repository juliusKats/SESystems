<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
// use Faker\Core\File;
use App\Mail\EstablishmentHodReceived;
use App\Mail\EstablishmentHodRecieved;
use App\Mail\EstablishmentSent;
use App\Mail\Recieve;
use App\Models\DocStatus;
use App\Models\DocStatuses;
use App\Models\UserFiles;
use App\Models\Version;
use App\Models\VoteDetails;
use App\Services\UniqueNumberGenerator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class EstablishmentController extends Controller
{
    private function generateUniqueRandomNumber(string $columnName, int $length = 13): string
    {
        do {
            // Generate a random string of specified length
            //            $randomNumber = Str::random($length);
            $randomNumber = mt_rand(1000000000000, 9999999999999);
            $randomNumber = (string)$randomNumber; // Ensuring it is Sting;

            // Check if the generated number already exists in the database
            $exists = UserFiles::where($columnName, $randomNumber)->exists();
        } while ($exists); // Loop until a unique number is found

        return $randomNumber;
    }

    /**
     * Display a listing of the resource.
     */
    public function Dashboard(Request $request)
    {
        $user = Auth::user();
        return view("FileManager.ESTABLISHMENT.Dashboard", compact("user",));
    }

    public function index()
    {
        //Deleted
        $deleted = UserFiles::onlyTrashed()->select('user_files.id', 'user_files.Draft', 'user_files.status', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'doc_statuses.statusName as status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.Approve as PSDate', 'user_files.ApprovedOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at', 'user_files.updated_at as UpdateDate', 'user_files.UpdatedBy')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'user_files.status')
            ->where('user_files.Draft', false)
            ->orderBy("user_files.deleted_at", "desc")->get();
        // Approved files
        $files = UserFiles::select('user_files.id', 'user_files.Draft', 'user_files.status', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'doc_statuses.statusName as status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.ApprovedOn as PSDate', 'user_files.ApprovedOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at', 'user_files.updated_at as UpdateDate', 'user_files.UpdatedBy')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'user_files.status')
            ->where('user_files.status', 3)
            ->where('user_files.Draft', false)
            ->orderBy("created_at", "desc")->get(); // Master Query
        // Pending
        $pending = UserFiles::select('user_files.status', 'user_files.Draft', 'user_files.id', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'doc_statuses.statusName as status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.ApprovedOn as PSDate', 'user_files.ApprovedOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at', 'user_files.updated_at as UpdateDate', 'user_files.UpdatedBy')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'user_files.status')
            ->where('user_files.status', 2)
            ->where('user_files.Draft', false)
            ->orderBy("created_at", "desc")->get();
        // my penfing
        $mypending = UserFiles::select('user_files.id', 'user_files.Draft', 'user_files.status', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'doc_statuses.statusName as status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.ApprovedOn as PSDate', 'user_files.ApprovedOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at', 'user_files.updated_at as UpdateDate', 'user_files.UpdatedBy')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'user_files.status')
            ->where('user_files.status', 2)
            ->where('user_files.Draft', false)
            ->where('user_files.UploadedBy', Auth::user()->id)
            ->orderBy("created_at", "desc")->get();

        $rejected = UserFiles::select('user_files.id', 'user_files.Draft', 'user_files.status', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'doc_statuses.statusName as status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.ApprovedOn as PSDate', 'user_files.ApprovedOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at', 'user_files.updated_at as UpdateDate', 'user_files.UpdatedBy')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'user_files.status')
            ->where('user_files.status', 4)
            ->where('user_files.Draft', false)
            ->orderBy("created_at", "desc")->get();
        // my penfing
        $myrejected = UserFiles::select('user_files.status', 'user_files.Draft', 'user_files.status', 'user_files.id', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'doc_statuses.statusName as status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.ApprovedOn as PSDate', 'user_files.ApprovedOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at', 'user_files.updated_at as UpdateDate', 'user_files.UpdatedBy')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'user_files.status')
            ->where('user_files.status', 4)
            ->where('user_files.Draft', false)
            ->where('user_files.UploadedBy', Auth::user()->id)
            ->orderBy("created_at", "desc")->get();

        $mydrafts = UserFiles::select('user_files.status', 'user_files.Draft', 'user_files.status', 'user_files.id', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'doc_statuses.statusName as status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.ApprovedOn as PSDate', 'user_files.ApprovedOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at', 'user_files.updated_at as UpdateDate', 'user_files.UpdatedBy')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'user_files.status')
            ->where('user_files.Draft', true)
            ->where('user_files.UploadedBy', Auth::user()->id)
            ->orderBy("created_at", "desc")->get();


        $mydeleted = UserFiles::onlyTrashed()->select('user_files.id', 'user_files.Draft', 'user_files.status', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'doc_statuses.statusName as status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.ApprovedOn as PSDate', 'user_files.ApprovedOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at', 'user_files.updated_at as UpdateDate', 'user_files.UpdatedBy')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'user_files.status')
            ->where('user_files.UploadedBy', Auth::user()->id)
            ->orderBy("user_files.deleted_at", "desc")->get();

        return view("FileManager.ESTABLISHMENT.index", compact("files", 'pending', 'mypending', 'rejected', 'myrejected', 'deleted', 'mydeleted', 'mydrafts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $versions = Version::orderBy("created_at", "desc")->get();
        $votes    = VoteDetails::orderBy("created_at", "desc")->get();
        return view("FileManager.ESTABLISHMENT.add", compact("votes", 'versions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Generate a unique random number for the 'your_column' column
        $uniqueNumber = $this->generateUniqueRandomNumber('ticket', 13);



        if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin') {
            $status = 3;
            $approved_by = Auth::user()->id;
            $ApprovedBy = Auth::user()->fname . " " . Auth::user()->sname . " " . Auth::user()->oname;
            $dateon = Carbon::now();
        } else {
            $status = 2;
            $approved_by = null;
            $ApprovedBy = null;
            $dateon = null;
        }

        $year  = date("Y");
        $month = date("M");
        $data  = $request->validate([
            'votecode'     => 'required|string|exists:vote_details,id',
            'votename'     => 'required|string|min:2',
            'comment'      => 'required|string|min:3',
            'excel'        => 'required|file|mimes:xlsx,xls|max:4096',
            'version'      => 'required|exists:versions,id',
            'pdf'          => 'required',
            'pdf.*'        => 'required|mimes:pdf|max:4096',
            'approvaldate' => 'required|date|before:today',
        ]);
        if ($request->save) {
            $exist = UserFiles::where('VoteCode', '=', $request->votecode)->where('versionId', $request->version)->exists();
            if ($exist) {
                return back()->with('error', 'A vote with the selected version already exists');
            } else {
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

                if ($request->file('excel') != null) {
                    $Vfilename = $request->file('excel')->getClientOriginalName();
                    $Vsize     = $request->file('excel')->getSize();
                }
                if ($request->file('pdf') != null) {
                    $PSfilename = $request->file('pdf')->getClientOriginalName();
                    $PSsize     = $request->file('pdf')->getSize();
                }

                $foldermonth = $year . "/" . $month;
                $pdf         = "PSPDF";
                $excel       = "Excel";
                $pdfvote     = "Votes/" . $year . "/" . $month . "/" . $pdf;
                $excelvote   = "Votes/" . $year . "/" . $month . "/" . $excel;

                $date      = Carbon::now();
                $date      = $date->format("D_d_M_Y_") . time() . "_";
                $pfile     = $request->file("pdf");
                $poriginal = $pfile->getClientOriginalName();
                $pfname    = $date . $poriginal;
                $ppath     = $pfile->move(public_path('storage/' . $pdfvote), $pfname);

                $efile     = $request->file("excel");
                $ext       = $efile->getClientOriginalExtension();
                $eoriginal = $efile->getClientOriginalName();
                $efname    = $date . $eoriginal;
                $epath     = $efile->move(public_path('storage/' . $excelvote), $efname);

                $file = UserFiles::create([
                    'VoteCode'    => $request->votecode,
                    'VoteName'    => $request->votename,
                    'excelfile'   => $efname,
                    'pdffile'     => $pfname,
                    'versionId' => $request->version,
                    'ApprovedOn'  => $request->approvaldate,
                    'status'      => $status,
                    'comment'     => $votecomment,
                    'ticket' => $uniqueNumber,
                    'UploadedBy'  => Auth::user()->id,
                    'ApprovedBy' => $ApprovedBy,
                    'approved_by' => $approved_by,
                    'DateOn' => $dateon


                ]);
                $establishment = DB::table('user_files')->select('user_files.ticket', 'users.sname', 'users.fname', 'user_files.created_at', 'users.email')
                    ->join('users', 'users.id', '=', 'user_files.UploadedBy')
                    ->where('user_files.id', $file->id)
                    ->first();
                // dd($establishment);

                // copy to the Hod

                $hodEmail = 'allan.tumuhimbise@publicservice.go.ug';
                $sendermail = Auth::user()->email;

                $subject = 'New Establishment Uploaded ' . $file->ticket;
                $data = [
                    'fname' => $establishment->fname,
                    'sname' => $establishment->sname,
                    'ticket' => $establishment->ticket,
                    'created_at' => $establishment->created_at,
                    'url' => route('file.approve', $file->id),
                    'message' => 'Welcome to our service!'
                ];

                // Send email using a Blade view
                Mail::send('FileManager.Mails.Establishment.Recieve', $data, function ($message) use ($hodEmail, $subject) {
                    $message->to($hodEmail)
                        ->subject($subject);
                });

                //coppy to sender

                $subject = 'Eatablishment with ticket Number' . $establishment->ticket . 'has been sent';
                $data = [
                    'fname' => $establishment->fname,
                    'sname' => $establishment->sname,
                    'ticket'                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      => $establishment->ticket,
                    'created_at' => $establishment->created_at,
                    'message' => 'Welcome to our service!'
                ];

                // Send email using a Blade view
                Mail::send('FileManager.Mails.Establishment.SenderCopy', $data, function ($message) use ($hodEmail, $subject) {
                    $message->to(Auth::user()->email)->subject($subject);
                });
                return redirect()->route('file.list')->with('success', 'File Uploaded Successfully');
            }
        } else {

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

            if ($request->file('excel') != null) {
                $Vfilename = $request->file('excel')->getClientOriginalName();
                $Vsize     = $request->file('excel')->getSize();
            }
            if ($request->file('pdf') != null) {
                $PSfilename = $request->file('pdf')->getClientOriginalName();
                $PSsize     = $request->file('pdf')->getSize();
            }

            $foldermonth = $year . "/" . $month;
            $pdf         = "PSPDF";
            $excel       = "Excel";
            $pdfvote     = "Votes/" . $year . "/" . $month . "/" . $pdf;
            $excelvote   = "Votes/" . $year . "/" . $month . "/" . $excel;

            $date = Carbon::now();
            $date = $date->format("D_d_M_Y_") . time() . "_";
            $pfile     = $request->file("pdf");
            $poriginal = $pfile->getClientOriginalName();
            $pfname    = $date . $poriginal;
            $ppath     = $pfile->move(public_path('storage/' . $pdfvote), $pfname);

            $efile     = $request->file("excel");
            $ext       = $efile->getClientOriginalExtension();
            $eoriginal = $efile->getClientOriginalName();
            $efname    = $date . $eoriginal;
            $epath     = $efile->move(public_path('storage/' . $excelvote), $efname);

            $file = UserFiles::create([
                'VoteCode'    => $request->votecode,
                'VoteName'    => $request->votename,
                'excelfile'   => $efname,
                'pdffile'     => $pfname,
                'versionId' => null,
                'ApprovedOn'  => $request->approvaldate,
                'status'      => $status,
                'comment'     => $votecomment,
                'Draft' => true,
                'ticket' => $uniqueNumber,
                'UploadedBy'  => Auth::user()->id,

            ]);

            return redirect()->route('file.list')->with('success', 'File Uploaded Successfully');
        }
    }
    public function deleteVote(Request $request, $id)
    {
        // withTrashed()->findOrFail($id)
        $userfile = UserFiles::withTrashed()->findOrFail($id);
        $pdf      = $userfile->pdffile;
        $excel    = $userfile->excelfile;
        if ($pdf) {
            $pdfyear  = explode('_', $pdf)[3];
            $pdfmonth = explode('_', $pdf)[2];
            $pdfpath  = "Votes/" . $pdfyear . "/" . $pdfmonth . "/PSPDF/" . $pdf;
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
        return redirect()->route('file.list')->with('success', 'All Files Deleted Successfully');
    }
    public function deleteAll(Request $request, $id)
    {
        $userfile   = UserFiles::find($id);
        $pdf        = $userfile->pdffile;
        $excel      = $userfile->excelfile;
        $year       = explode('_', $pdf)[3];
        $month      = explode('_', $pdf)[2];
        $pdfpath    = "Votes/" . $year . "/" . $month . "/PSPDF/" . $pdf;
        $excelpath  = "Votes/" . $year . "/" . $month . "/EXCEL/" . $excel;
        $excelexist = File::delete(public_path('storage/' . $excelpath));
        $pdfexist   = File::delete(public_path('storage/' . $pdfpath));

        if ($excelexist and $pdfexist) {
            File::delete(public_path('storage/' . $pdfpath));
            File::delete(public_path('storage/' . $excelpath));
            $userfile->pdffile    = null;
            $userfile->excelfile  = null;
            $userfile->Updated_at = Carbon::now();
            $userfile->UpdatedBy  = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;

            $userfile->save();
            return redirect()->route('file.list')->with('success', 'All Files Deleted Successfully');
        } else if ($excelexist == true and $pdfexist == false) {
            File::delete(public_path('storage/' . $excelpath));
            $userfile->excelfile  = null;
            $userfile->Updated_at = Carbon::now();
            $userfile->UpdatedBy  = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;
            $userfile->save();
            return redirect()->route('file.list')->with('success', 'All Files Deleted Successfully');
        } else if ($excelexist == false and $pdfexist == true) {
            File::delete(public_path('storage/' . $pdfpath));
            $userfile->pdffile    = null;
            $userfile->Updated_at = Carbon::now();
            $userfile->UpdatedBy  = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;
            $userfile->save();
        } else {
            return redirect()->route('file.list')->with('error', 'No Files Found');
        }
    }
    public function deletePDF(Request $request, $id)
    {
        $userfile = UserFiles::find($id);
        $pdf      = $userfile->pdffile;
        // dd($pdf);
        $year  = explode('_', $pdf)[3];
        $month = explode('_', $pdf)[2];
        $path  = "Votes/" . $year . "/" . $month . "/PSPDF/" . $pdf;
        if (File::exists(public_path('storage/' . $path))) {
            File::delete(public_path('storage/' . $path));
            $userfile->pdffile    = null;
            $userfile->Updated_at = Carbon::now();
            $userfile->UpdatedBy  = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;
            $userfile->save();

            return redirect()->route('file.list')->with('success', 'PDF Deleted Successfully');
        } else {
            return redirect()->route('file.list')->with('error', 'PDF Not Found');
        }
    }

    public function deleteExcel(Request $request, $id)
    {
        $userfile = UserFiles::find($id);
        $excel    = $userfile->excelfile;
        $year     = explode('_', $excel)[3];
        $month    = explode('_', $excel)[2];
        $path     = "Votes/" . $year . "/" . $month . "/EXCEL/" . $excel;
        if (File::exists(public_path('storage/' . $path))) {
            File::delete(public_path('storage/' . $path));
            $userfile->excelfile  = null;
            $userfile->Updated_at = Carbon::now();
            $userfile->UpdatedBy  = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;
            $userfile->save();
            return redirect()->route('file.list')->with('success', 'PDF Deleted Successfully');
        } else {
            return redirect()->route('file.list')->with('error', 'PDF Not Found');
        }
    }

    public function ApproveFile(Request $request, $id)
    {
        $file   = UserFiles::find($id);
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
            return redirect()->route('file.list')->with('success', 'file De-activated');
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
            return redirect()->route('file.list')->with('success', 'Vote Activated');
        }
    }

    public function RejectFile(Request $request, $id)
    {
        $file = UserFiles::select('user_files.id', 'user_files.Draft', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'doc_statuses.statusName as status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.ApprovedOn as PSDate', 'user_files.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at as CrDate', 'user_files.updated_at as UpDate', 'user_files.UpdatedBy')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'user_files.status')
            ->where('user_files.id', $id)
            ->orderBy("UpDate", "desc")->first();
        // dd($file);
        return view('FileManager.Establishment.reject_vote', compact('file'));
    }

    public function RejectSave(Request $request, $id)
    {
        $file = UserFiles::find($id);
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
            return redirect()->route('file.list')->with('success', 'Rejection Reason Successfully added');
        } else {
            return redirect()->route('file.reject', $id)->with('error', 'Something Went Wrong');
        }
    }
    public function SoftDelete(Request $request, $id)
    {
        $file         = UserFiles::find($id);
        $file->status = null;
        $file->delete();
        return redirect()->route('file.list')->with('success', 'File moved to Bin successfully');
    }

    public function Restore($id)
    {
        $vote         = UserFiles::withTrashed()->findOrFail($id);
        $vote->status = 2;
        $vote->restore();
        return redirect()->route('file.list')->with('success', 'File Restored successfully');
    }

    public function show(Request $request, $id)
    {
        $votes = VoteDetails::all();
        $status = DocStatus::all();
        $versions = Version::all();
        $file = UserFiles::select('user_files.id', 'user_files.Draft', 'user_files.VoteCode as VCode', 'user_files.ticket', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'user_files.status as State', 'doc_statuses.statusName as status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.ApprovedOn as PSDate', 'user_files.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at as CrDate', 'user_files.updated_at as UpDate', 'user_files.UpdatedBy', 'users.fname', 'users.sname', 'users.oname', 'user_files.versionId', 'user_files.ticket','user_files.Reason', 'versions.versionName')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'user_files.status')
            ->join('versions', 'versions.id', '=', 'user_files.versionId')
            ->where('user_files.id', $id)->first();
        // dd($file);
        return view('FileManager.ESTABLISHMENT.view', compact('file', 'votes', 'versions', 'status'));
    }
}
