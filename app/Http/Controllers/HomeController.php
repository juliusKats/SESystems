<?php
namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\ContactUS;
use App\Models\ImageCategory;
use App\Models\JobDocuments;
use App\Models\Questions;
use App\Models\RapexDocuments;
use App\Models\Services;
use App\Models\ServiceScheme;
use App\Models\User;
use App\Models\UserFiles;
use App\Models\VoteDetails;
use App\Models\YearMonths;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use ZipArchive;

class HomeController extends Controller

{
    public function ContactUS(Request $request)
    {
        return view('FileManager.Home.contact_us');
    }
    public function index()
    {
        $yearz = "yearz";
        $votes = VoteDetails::all();
        $years = User::distinct()->get(['created_at'])->groupBy('created_at');
        $yrs   = VoteDetails::selectRaw('extract(year FROM created_at) AS year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();
        $yearfinal = User::select([DB::raw('extract(year FROM created_at) AS year')])
            ->get()
            ->unique('year')
            ->sortBy('year');
        $entities = Services::all();
        $months   = YearMonths::all();
        // dd($votes);
        return view('FileManager.Home.Dashboard', compact('votes', 'months', 'years', 'yrs', 'yearfinal', 'entities'));
    }
    public function Establishment(Request $request)
    {
        $votes = VoteDetails::all();
        $files = UserFiles::select('user_files.id', 'vote_details.votecode', 'vote_details.VoteName', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.Approve', 'user_files.status', 'user_files.ApprovedOn', 'user_files.UploadedBy', 'user_files.ApprovedBy', 'user_files.UploadedOn', 'user_files.created_at', 'user_files.updated_at')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->where('user_files.status', 3)->get();

        return view('FileManager.Home.Establishment', compact('votes', 'files'));
    }

    public function JobDescription()
    {
        $votes      = VoteDetails::all();
        $allactives = JobDocuments::select('job_documents.id', 'card_ministries.carderName as ministry', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->join('card_ministries', 'card_ministries.id', '=', 'job_documents.carder_id')
            ->where('job_documents.status', 3)
            ->orderBy("created_at", "desc")->get();
        return view('FileManager.Home.Job_description', compact('allactives', 'votes'));

    }

    public function RapexDocuments()
    {
        $votes     = VoteDetails::all();
        $allactive = DB::table('rapex_documents')->select
        ('rapex_documents.id', 'rapex_documents.entity', 'rapex_documents.institution', 'rapex_documents.file', 'rapex_documents.comment', 'rapex_documents.zoomlink', 'rapex_documents.updated_at', 'rapex_documents.created_at', 'rapex_documents.deleted_at', 'rapex_documents.DeletedBy', 'rapex_documents.RestoredBy', 'rapex_documents.UploadedOn', 'rapex_documents.UploadedBy', 'rapex_documents.ApprovedBy', 'rapex_documents.UpdatedBy', 'rapex_documents.approved_by', 'doc_statuses.statusName', 'rapex_documents.DateOn', 'rapex_documents.RejectedBy', 'rapex_documents.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'rapex_documents.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'rapex_documents.status')
            ->where('rapex_documents.status', 3)
            ->get();
        return view('FileManager.Home.Rapex_Documents', compact('allactive', 'votes'));
    }

    public function ServiceSchemes()
    {
        $votes      = VoteDetails::all();
        $allactives = ServiceScheme::select('service_schemes.id', 'card_ministries.carderName as ministry', 'service_schemes.CarderName', 'service_schemes.ext', 'service_schemes.comment as VComment', 'service_schemes.status', 'service_schemes.WordFile as EXCEL', 'service_schemes.PDFFile as PDF', 'service_schemes.ApprovedOn as PSDate', 'service_schemes.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'service_schemes.UploadedBy', 'service_schemes.ApprovedBy as UpprovedBy', 'service_schemes.UploadedOn as UploadDate', 'service_schemes.created_at', 'service_schemes.updated_at as UpdateDate', 'service_schemes.UpdatedBy', 'service_schemes.DeletedBy', 'service_schemes.RestoredBy')
            ->join('users', 'users.id', '=', 'service_schemes.UploadedBy')
            ->join('card_ministries', 'card_ministries.id', '=', 'service_schemes.carder_id')
            ->where('service_schemes.status', 3)
            ->orderBy("created_at", "desc")->get();
        return view('FileManager.Home.service_schemes', compact('allactives', 'votes'));

    }

    public function FrequentQuestions()
    {
        $firstquestion = Questions::where('is_replied', true)->first();
        $questions     = Questions::where('is_replied', true)->orderBy('created_at', 'desc')->get();
        return view('FileManager.Home.frequent_questions', compact('questions', 'firstquestion'));
    }
    public function AskQuestion(Request $request)
    {
        $data = $request->validate([
            'telephone' => 'required|string|min:10',
            'question'  => 'required|string|min:5',
            'qndetails' => 'nullable|string|min:10',
        ]);
        $question = Questions::create([
            'mobile'   => $request->telephone,
            'question' => $request->question,
            'details'  => $request->qndetails,
        ]);

        return back()->with('success', 'Question Sent!! Successfully');
    }

    public function Gallery()
    {
        $categories = ImageCategory::all();
        $path = public_path('storage/gallery/Establishment');
        // $path2 = public_path('images/resized/kitchens');
        $images = File::allFiles($path);
        // $images2 = File::allFiles($path2);
        // return view('front.gallery.gallery',[
        //     'images' => $images,
        //     'images2' => $images2
        // ]);
        return view('FileManager.Home.gallery', compact('images','categories'));
    }


}
