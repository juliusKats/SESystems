<?php
namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use App\Models\ContactUS;
use App\Models\CountryCodes;
use App\Models\EDBRTeam;
use App\Models\Inquiries;
use App\Models\JobDocuments;
use App\Models\Questions;
use App\Models\RapexDocuments;
use App\Models\RapexImages;
use App\Models\Services;
use App\Models\ServiceScheme;
use App\Models\ServiceUgandaCenter;
use App\Models\UserFiles;
use App\Models\VoteDetails;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Twilio\Rest\Client;
use ZipArchive;

class FrontEndController extends Controller
{
    public function UserInquiry(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required|min:5',
            'mobile'   => 'required|numeric|min:10',
            'email'    => 'nullable|email',
            'subject'=>'required|min:5|max:50',
            'question' => 'required|min:10|max:200',
        ]);
        $inquiry = Inquiries::create([
            'fullname'  => $request->fullname,
            'telephone' => $request->mobile,
            'email'     => $request->email,
            'subject'=>$request->subject,
            'inquiry'   => $request->question,
        ]);
        if ($inquiry and $request->email and $request->mobile) {
            // sms parrt
            $sid   = config('services.twilio.sid');
            $token= config('services.twilio.token');
            $fromNumber  = config('services.twilio.from');
            $txt        = "Hello " . $request->fullname .
                " Your Inquiry with subject '.$request->subject. ' Has been Recieved.
                     We Shall Reply You Shortly.
                     MINISTRY OF PUBLIC SERVICE ";
//            dd($sid);
            $client = new Client($sid, $token);
            $client->messages->create($inquiry->telephone, [
                'from' => $fromNumber,
                'body' => $txt,
            ]);

            // send email
            $email   = $request->email;
            $subject = $request->subject;
            Mail::raw($txt, function ($message) use ($email, $subject) {
                $message->to($email)
                    ->subject($subject);
            });
            return redirect()->back()->with('success', 'You question has been sent successfully');

        } else if ($inquiry and $request->email) {
            $email   = $request->email;
            $subject = $request->subject;
            $body    = 'Hello ' . $request->fullname .
                ' Your Inquiry Has been Recieved. We Shall Reply You Shortly. Thank you For contacting us MINISTRY OF PUBLIC SERVICE ';
            Mail::raw($body, function ($message) use ($email, $subject) {
                $message->to($email)
                    ->subject($subject);
            });
            return redirect()->back()->with('success', 'You question has been sent successfully');

        } else if ($inquiry and $request->mobile) {
            $sid        = env('TWILIO_ACCOUNT_SID');
            $token      = env('TWILIO_AUTH_TOKEN');
            $fromNumber = env('TWILIO_FROM_NUMBER');

            try {
                $client = new Client($sid, $token);
                $client->messages->create($inquiry->telephone, [
                    'from' => $fromNumber,
                    'body' => "Hello " . $request->fullname .
                    " Your Inquiry with subject '.$request->subject. ' Has been Recieved.
                     We Shall Reply You Shortly.
                     MINISTRY OF PUBLIC SERVICE ",
                ]);

                // return 'SMS Sent Successfully.';
                return redirect()->back()->with('success', 'You question has been sent successfully');
            } catch (Exception $e) {
                // return 'Error: ' . $e->getMessage();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

    }

    public function index()
    {
        $country     = CountryCodes::all();
        $services    = Services::all()->where('status', true);
        $teammembers = EDBRTeam::select('e_d_b_r_teams.id', 'users.sname', 'users.fname', 'users.oname', 'users.profile_photo_path', 'e_d_b_r_teams.title', 'e_d_b_r_teams.about', 'e_d_b_r_teams.twitter', 'e_d_b_r_teams.facebook', 'e_d_b_r_teams.instagram', 'e_d_b_r_teams.linkedin', 'e_d_b_r_teams.updated_at', 'e_d_b_r_teams.deleted_at')
            ->join('users', 'users.id', '=', 'e_d_b_r_teams.user_id')
            ->where('e_d_b_r_teams.status', true)->get();
        return view('FileManager.FrontEnd.entryPage', compact('teammembers', 'services', 'country'));
    }
    public function contactus()
    {
        return view('FileManager.FrontEnd.Pages.contact_us');
    }
    public function ContactUsSave(Request $request)
    {

        $data = $request->validate([
            'fullname'     => 'required|string|min:7',
            'telephone'    => 'required|numeric|min:10',
            'email'        => 'nullable|email',
            'subject'      => 'required|string|min:5',
            'message'      => 'required|string|min:15',
            'screenshot'   => 'nullable',
            'screenshot.*' => 'nullable|file|mimes:jpeg,jpg,png,doc,docx,xlsx,xls,pdf',
        ]);

        $year        = date("Y");
        $month       = date("M");
        $contactpath = 'ContactUS/' . $year . "/" . $month;

        $shortArray = [];
        if ($request->hasFile('screenshot')) {
            $files = $request->file('screenshot');
            foreach ($files as $file) {
                $origFileName = $file->getClientOriginalName();
                $filename     = Carbon::now() . "f_" . $origFileName;
                $path         = $file->move(public_path('storage/' . $contactpath), $filename);
                $imgArray[]   = $filename;
            }
            $shortArray = implode(",", $imgArray);

            $maildata = ContactUS::create([
                'fullname'   => $request->fullname,
                'telephone'  => $request->telephone,
                'email'      => $request->email,
                'subject'    => $request->subject,
                'message'    => $request->message,
                'screenshot' => $shortArray,
            ]);
            if ($maildata) {
                Mail::to('tumuhimbiseallan@gmail.com|ezychicchiz@gmail.com')->send(new ContactFormMail($maildata));

                return redirect()->route('contact-us')->with('success', 'Your Mail has been received');
            } else {
                return redirect()->route('contact-us')->with('error', 'Your Message is not Delivered, Try againr');
            }
        } else {

            $maildata = ContactUS::create([
                'fullname'  => $request->fullname,
                'telephone' => $request->telephone,
                'email'     => $request->email,
                'subject'   => $request->subject,
                'message'   => $request->message,
            ]);
            if ($maildata) {
                Mail::to(['tumuhimbiseallan@gmail.com', 'ezychicchiz@gmail.com'])->send(new ContactFormMail($maildata));
                return redirect()->route('contact-us')->with('success', 'Your Mail has been received');
            } else {
                return redirect()->route('contact-us')->with('error', 'Your Message is not Delivered, Try againr');
            }
        }

    }
    public function FrequentQuestion()
    {
        $firstquestion = Questions::where('is_replied', true)->first();
        $questions     = Questions::where('is_replied', true)->orderBy('created_at', 'desc')->get();
        return view('FileManager.FrontEnd.Pages.frequentQn', compact('questions', 'firstquestion'));

    }
    public function BlogFive()
    {
        $images = RapexImages::orderBy('created_at', 'desc')->get();
        return view('FileManager.FrontEnd.Pages.BlogFive', compact('images'));

    }
    public function Establishment(Request $request)
    {

        $files = UserFiles::select('user_files.id', 'user_files.Draft', 'vote_details.votecode', 'user_files.VoteName', 'user_files.status', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'doc_statuses.statusName as status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.ApprovedOn as PSDate', 'user_files.ApprovedOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at', 'user_files.updated_at as UpdateDate', 'user_files.UpdatedBy')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'user_files.status')
            ->where('user_files.status', 3)
            ->where('user_files.Draft', false)
            ->orderBy("created_at", "desc")->get(); 
        // $files = UserFiles::select('user_files.id', 'vote_details.votecode', 'user_files.VoteName', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.Approve', 'user_files.status', 'user_files.ApprovedOn', 'user_files.UploadedBy', 'user_files.ApprovedBy', 'user_files.UploadedOn', 'user_files.created_at', 'user_files.updated_at', 'versions.versionname')
        //     ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
        //     ->join('versions', 'versions.id', '=', 'user_files.versionId')
        //     ->where('user_files.status', 3)->get();

        return view('FileManager.FrontEnd.Pages.establishment', compact('files'));
    }

    public function Jobs(Request $request)
    {

        $allactives = JobDocuments::select('job_documents.id', 'card_ministries.carderName as ministry', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy', 'versions.versionname')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->join('card_ministries', 'card_ministries.id', '=', 'job_documents.carderId')
            ->join('versions', 'versions.id', '=', 'job_documents.versionId')
            ->where('job_documents.status', 3)
            ->orderBy("created_at", "desc")->get();
        return view('FileManager.FrontEnd.Pages.jobs', compact('allactives'));
    }
    public function Schemes(Request $request)
    {

        $allactives = ServiceScheme::select('service_schemes.id', 'card_ministries.carderName as ministry', 'service_schemes.CarderName', 'service_schemes.ext', 'service_schemes.comment as VComment', 'service_schemes.status', 'service_schemes.WordFile as EXCEL', 'service_schemes.PDFFile as PDF', 'service_schemes.ApprovedOn as PSDate', 'service_schemes.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'service_schemes.UploadedBy', 'service_schemes.ApprovedBy as UpprovedBy', 'service_schemes.UploadedOn as UploadDate', 'service_schemes.created_at', 'service_schemes.updated_at as UpdateDate', 'service_schemes.UpdatedBy', 'service_schemes.DeletedBy', 'service_schemes.RestoredBy', 'versions.versionname')
            ->join('users', 'users.id', '=', 'service_schemes.UploadedBy')
            ->join('card_ministries', 'card_ministries.id', '=', 'service_schemes.carderId')
            ->join('versions', 'versions.id', '=', 'service_schemes.versionId')
            ->where('service_schemes.status', 3)
            ->orderBy("created_at", "desc")->get();
        return view('FileManager.FrontEnd.Pages.scheme', compact('allactives'));
    }
    public function Rapex(Request $request)
    {
        $votes     = VoteDetails::all();
        $allactive = DB::table('rapex_documents')->select
        ('rapex_documents.id', 'rapex_documents.entity', 'rapex_documents.institution', 'rapex_documents.file', 'rapex_documents.comment', 'rapex_documents.zoomlink', 'rapex_documents.updated_at', 'rapex_documents.created_at', 'rapex_documents.deleted_at', 'rapex_documents.DeletedBy', 'rapex_documents.RestoredBy', 'rapex_documents.UploadedOn', 'rapex_documents.UploadedBy', 'rapex_documents.ApprovedBy', 'rapex_documents.UpdatedBy', 'rapex_documents.approved_by', 'doc_statuses.statusName', 'rapex_documents.DateOn', 'rapex_documents.RejectedBy', 'rapex_documents.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'rapex_documents.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'rapex_documents.status')
            ->where('rapex_documents.status', 3)
            ->get();
        return view('FileManager.FrontEnd.Pages.Rapex', compact('allactive'));
    }
    public function ServiceUg(Request $request)
    {
        // $files ="hi";
        $files = DB::table('service_uganda_centers')->select
        ('service_uganda_centers.id', 'service_uganda_centers.SUCenter', 'service_uganda_centers.file', 'service_uganda_centers.comment', 'service_uganda_centers.zoomlink', 'service_uganda_centers.updated_at', 'service_uganda_centers.created_at', 'service_uganda_centers.deleted_at', 'service_uganda_centers.DeletedBy', 'service_uganda_centers.RestoredBy', 'service_uganda_centers.UploadedOn', 'service_uganda_centers.UploadedBy', 'service_uganda_centers.ApprovedBy', 'service_uganda_centers.UpdatedBy', 'service_uganda_centers.approved_by', 'doc_statuses.statusName', 'service_uganda_centers.DateOn', 'service_uganda_centers.RejectedBy', 'service_uganda_centers.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'service_uganda_centers.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'service_uganda_centers.status')
            ->where('service_uganda_centers.status', 3)
            ->get();
        return view('FileManager.FrontEnd.Pages.serviceug', compact('files'));

    }

    // file preview
    public function previewPdf(Request $request, $id)
    {
        $pdf = UserFiles::find($id);

        $pdffile = $pdf->pdffile;
        $pdf     = explode('_', $pdffile);
        $month   = $pdf[2];
        $year    = $pdf[3];                                                        //file name in db
        $path    = "storage/Votes/" . $year . "/" . $month . "/PSPDF/" . $pdffile; //path of pdf
        $file    = File::get($path);
        // dd($path);
        $response = Response::make($file, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline;' . $pdffile,
        ]);
        return $response;
    }
    public function previewExcel(Request $request, $id)
    {
        $pdf       = UserFiles::find($id);
        $excelfile = $pdf->excelfile;
        $pdf       = explode('_', $excelfile);
        $month     = $pdf[2];
        $year      = $pdf[3];                                                          //file name in db
        $path      = "storage/Votes/" . $year . "/" . $month . "/EXCEL/" . $excelfile; //path of pdf
        $file      = File::get($path);
        $response  = Response::make($file, 200, [
            'Content-Type'        => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline;' . $excelfile,
        ]);
        return $response;
    }
// File Downloads
    public function downloadPdf(Request $request, $id)
    {
        $pdf     = UserFiles::find($id);
        $pdffile = $pdf->pdffile;
        $pdfx    = explode('_', $pdffile);
        $month   = $pdfx[2];
        $year    = $pdfx[3];                                                       //file name in db
        $path    = "storage/Votes/" . $year . "/" . $month . "/PSPDF/" . $pdffile; //path of pdf
        $name    = $pdfx[5];
        $headers = ['Content-Type' => 'application/pdf'];
        return Response::download($path, $name, $headers);
    }
    public function downloadExcel(Request $request, $id)
    {
        $pdf       = UserFiles::find($id);
        $excelfile = $pdf->excelfile;
        $excels    = explode('_', $excelfile);
        $month     = $excels[2];
        $year      = $excels[3];                                                       //file name in db
        $path      = "storage/Votes/" . $year . "/" . $month . "/EXCEL/" . $excelfile; //path of pdf
        $name      = $excels[5];
        $headers   = ['Content-Type' => 'application/vnd.ms-excel'];
        return Response::download($path, $name, $headers);
    }
    public function ViewVote(Request $request, $id)
    {
        $votes = VoteDetails::all();
        $file  = UserFiles::select('user_files.id', 'vote_details.votecode as VCode', 'vote_details.votename as VName', 'user_files.comment as VComment', 'user_files.status', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.Approve as PSDate', 'user_files.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'user_files.UploadedBy', 'user_files.ApprovedBy as UpprovedBy', 'user_files.UploadedOn as UploadDate', 'user_files.created_at as CrDate', 'user_files.updated_at as UpDate', 'user_files.UpdatedBy')
            ->join('users', 'users.id', '=', 'user_files.UploadedBy')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->where('user_files.id', $id)
            ->orderBy("UpDate", "desc")->first();
        // dd($file);
        return view('FileManager.Home.view_vote', compact('votes', 'file'));

    }
    // Job PDF View
    public function previewJobPdf(Request $request, $id)
    {
        $pdf = JobDocuments::find($id);

        $pdffile = $pdf->PDFFile;
        // dd($pdffile);
        $pdf   = explode('_', $pdffile);
        $month = $pdf[2];
        $year  = $pdf[3];                                                       //file name in db
        $path  = "storage/Jobs/" . $year . "/" . $month . "/PSPDF/" . $pdffile; //path of pdf
        $file  = File::get($path);
        // dd($path);
        $response = Response::make($file, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline;' . $pdffile,
        ]);
        return $response;
    }
    public function downloadJobPdf(Request $request, $id)
    {
        $pdf     = JobDocuments::find($id);
        $pdffile = $pdf->PDFFile;
        // dd($pdffile);
        $pdfx  = explode('_', $pdffile);
        $month = $pdfx[2];
        $year  = $pdfx[3];                                                      //file name in db
        $path  = "storage/Jobs/" . $year . "/" . $month . "/PSPDF/" . $pdffile; //path of pdf
        $name  = $pdfx[5];
        // dd($name);
        $headers = ['Content-Type' => 'application/pdf'];
        return Response::download($path, $name, $headers);
    }
    public function downloadJobExcel(Request $request, $id)
    {
        $pdf       = JobDocuments::find($id);
        $excelfile = $pdf->excelfile;
        $excelext  = $pdf->ext;
        $excels    = explode('_', $excelfile);
        $month     = $excels[2];
        $year      = $excels[3];
        if ($excelext == 'pdf') {                                                //file name in db
            $path = "storage/Jobs/" . $year . "/" . $month . "/JDPDF/" . $excelfile; //path of pdf
        } else {
            $path = "storage/Jobs/" . $year . "/" . $month . "/JDDOC/" . $excelfile; //path of pdf
        }
        $name    = $excels[5];
        $headers = ['Content-Type' => 'application/vnd.ms-excel'];
        return Response::download($path, $name, $headers);
    }
    public function createZip(Request $request, $id)
    {
        $Rapex       = RapexDocuments::findOrFail($id);
        $filez       = $Rapex->file;
        $zipFileName = $Rapex->entity . '.zip';

        // $zipFileName = 'smaple.zip';
        // dd($filez);
        $zip = new ZipArchive();
        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === true) {
            $filesToZip = [];

            $attachments = explode(',', $filez);
            foreach ($attachments as $attache) {
                $pdfx  = explode('_', $attache);
                $month = $pdfx[1];
                $year  = $pdfx[2];
                $path  = "storage/Rapex/" . $year . "/" . $month . "/" . $attache;
                //  $filed  = File::get($path);
                $docArray[] = $path;

            }
            $filesToZip = implode(',', $docArray);
            // dd($filesToZip);

            $finalzip = explode(',', $filesToZip);
            // dd($finalzip);

            foreach ($finalzip as $file) {
                // dd($file);

                $zip->addFile($path, basename($file));
            }
            $zip->close();
            return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
        } else {
            return "Failed to create the zip file.";
        }

    }

    public function createZipSU(Request $request, $id)
    {
        $Rapex       = ServiceUgandaCenter::findOrFail($id);
        $filez       = $Rapex->file;
        $zipFileName = $Rapex->SUCenter . '.zip';
        $zip         = new ZipArchive();
        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === true) {
            $filesToZip = [];

            $attachments = explode(',', $filez);
            foreach ($attachments as $attache) {
                $pdfx  = explode('_', $attache);
                $month = $pdfx[1];
                $year  = $pdfx[2];
                $path  = "storage/SU/" . $year . "/" . $month . "/" . $attache;
                //  $filed  = File::get($path);
                $docArray[] = $path;

            }
            $filesToZip = implode(',', $docArray);
            // dd($filesToZip);

            $finalzip = explode(',', $filesToZip);
            // dd($finalzip);

            foreach ($finalzip as $file) {
                // dd($file);

                $zip->addFile($path, basename($file));
            }
            $zip->close();
            return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
        } else {
            return "Failed to create the zip file.";
        }

    }
    public function downloadSUfile(Request $request, $string)
    {
        $filedetails = $string;
        $fileinfo    = explode('_', $filedetails);
        $month       = $fileinfo[1];
        $year        = $fileinfo[2];
        $path        = "storage/SU/" . $year . "/" . $month . "/" . $filedetails; //path of pdf
        $fileext     = File::extension($path);
        if ($fileext == "docx" or $fileext == "doc") {
            $headers = ['Content-Type' => 'application/vnd.ms-word'];
            return Response::download($path, $filedetails, $headers);

        } else if ($fileext == "xlsx" or $fileext == "xls") {
            $headers = ['Content-Type' => 'application/vnd.ms-excel'];
            return Response::download($path, $filedetails, $headers);
        }
    }
    public function previewSUPdf(Request $request, $string)
    {
        $pdffile = $string;
        // dd($pdffile);
        $pdf   = explode('_', $pdffile);
        $month = $pdf[1];
        $year  = $pdf[2];                                               //file name in db
        $path  = "storage/SU/" . $year . "/" . $month . "/" . $pdffile; //path of pdf
        $file  = File::get($path);
        // dd($path);
        $response = Response::make($file, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline;' . $pdffile,
        ]);
        return $response;
    }

    // Refrom
    public function ReformIndex()
    {
        return view('FileManager.FrontEnd.pages.ReformIndex');
    }
    //productivivty
    public function ProductivityIndex()
    {
        return view('FileManager.FrontEnd.pages.ProductivityIndex');
    }
    //reserch
    public function ResearchIndex()
    {
        return view('FileManager.FrontEnd.pages.ResearchIndex');
    }
}
