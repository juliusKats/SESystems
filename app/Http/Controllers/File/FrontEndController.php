<?php
namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\JobDocuments;
use App\Models\Questions;
use App\Models\RapexImages;
use App\Models\ServiceScheme;
use App\Models\UserFiles;
use App\Models\VoteDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontEndController extends Controller
{
    public function Login()
    {
        return view('FileManager.FrontEnd.Pages.Login');
    }
    public function Register()
    {
        return view('FileManager.FrontEnd.Pages.Register');
    }
    public function index()
    {
        return view('FileManager.FrontEnd.entryPage');
    }
    public function contactus()
    {
        return view('FileManager.FrontEnd.Pages.contact_us');
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

        $files = UserFiles::select('user_files.id', 'vote_details.votecode', 'vote_details.VoteName', 'user_files.excelfile as EXCEL', 'user_files.pdffile as PDF', 'user_files.Approve', 'user_files.status', 'user_files.ApprovedOn', 'user_files.UploadedBy', 'user_files.ApprovedBy', 'user_files.UploadedOn', 'user_files.created_at', 'user_files.updated_at')
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->where('user_files.status', 3)->get();

        return view('FileManager.FrontEnd.Pages.establishment', compact( 'files'));
    }

    public function Jobs(Request $request)
    {

        $allactives = JobDocuments::select('job_documents.id', 'card_ministries.carderName as ministry', 'job_documents.CarderName', 'job_documents.ext', 'job_documents.comment as VComment', 'job_documents.status', 'job_documents.WordFile as EXCEL', 'job_documents.PDFFile as PDF', 'job_documents.ApprovedOn as PSDate', 'job_documents.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'job_documents.UploadedBy', 'job_documents.ApprovedBy as UpprovedBy', 'job_documents.UploadedOn as UploadDate', 'job_documents.created_at', 'job_documents.updated_at as UpdateDate', 'job_documents.UpdatedBy', 'job_documents.DeletedBy', 'job_documents.RestoredBy')
            ->join('users', 'users.id', '=', 'job_documents.UploadedBy')
            ->join('card_ministries', 'card_ministries.id', '=', 'job_documents.carder_id')
            ->where('job_documents.status', 3)
            ->orderBy("created_at", "desc")->get();
        return view('FileManager.FrontEnd.Pages.jobs', compact('allactives'));
    }
    public function Schemes(Request $request)
    {

        $allactives = ServiceScheme::select('service_schemes.id', 'card_ministries.carderName as ministry', 'service_schemes.CarderName', 'service_schemes.ext', 'service_schemes.comment as VComment', 'service_schemes.status', 'service_schemes.WordFile as EXCEL', 'service_schemes.PDFFile as PDF', 'service_schemes.ApprovedOn as PSDate', 'service_schemes.DateOn as ADMINApproval', 'users.sname', 'users.fname', 'users.oname', 'service_schemes.UploadedBy', 'service_schemes.ApprovedBy as UpprovedBy', 'service_schemes.UploadedOn as UploadDate', 'service_schemes.created_at', 'service_schemes.updated_at as UpdateDate', 'service_schemes.UpdatedBy', 'service_schemes.DeletedBy', 'service_schemes.RestoredBy')
            ->join('users', 'users.id', '=', 'service_schemes.UploadedBy')
            ->join('card_ministries', 'card_ministries.id', '=', 'service_schemes.carder_id')
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
    public function Service(Request $request)
    {
        return view('FileManager.FrontEnd.Pages.serviceug', compact( 'files'));

    }
}
