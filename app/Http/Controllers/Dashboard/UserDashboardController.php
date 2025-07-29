<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JobDocuments;
use App\Models\RapexDocuments;
use App\Models\ServiceScheme;
use App\Models\ServiceUgandaCenter;
use App\Models\User;
use App\Models\UserFiles;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $Todayz    = Carbon::now()->format('Y-m-d');
        $Yesterday = Carbon::now()->subDays(1)->format('Y-m-d');
        $weekStart = Carbon::now()->startOfWeek()->format('Y-m-d');
        $weekEnd   = Carbon::now()->endOfWeek()->format('Y-m-d');
        $lastweek  = Carbon::now()->startOfWeek()->subDays(7)->format('Y-m-d');
        // dd($weekStart);
        $past30    = Carbon::today()->subDays(30)->format('Y-m-d');
        $ThisMonth = Carbon::now()->format('m');
        $LastMonth = (Carbon::now()->format('m')) - 1;
        $ThisYear  = (Carbon::now()->format('Y'));
        $LastYear  = (Carbon::now()->format('Y')) - 1;

        // Establishments
        $myVotestoday     = UserFiles::where('created_at', '>=', $Todayz)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVoteslastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('UploadedBy', '=', Auth::user()->id)->count();
//Rejected
        $myVotesRejecttoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesRejectyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesRejectThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesRejectlastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesRejectThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesRejectLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesRejectLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesRejectThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
//Activated
        $myVotesActivetoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesActiveyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesActiveThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesActivelastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesActiveThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesActiveLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesActiveLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesActiveThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
// Deactivated
        $myVotesPendingtoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesPendingyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesPendingThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesPendinglastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesPendingThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesPendingLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesPendingLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myVotesPendingThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
// Job Description
        $myJobtoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJoblastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('UploadedBy', '=', Auth::user()->id)->count();
//Rejected
        $myJobRejecttoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobRejectyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobRejectThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobRejectlastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobRejectThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobRejectLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobRejectLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobRejectThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
//Activated
        $myJobActivetoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobActiveyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobActiveThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobActivelastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobActiveThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobActiveLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobActiveLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobActiveThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
// Deactivated
        $myJobPendingtoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobPendingyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobPendingThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobPendinglastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobPendingThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobPendingLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobPendingLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myJobPendingThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
// Scheme Of Service
        $mySchemetoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemelastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('UploadedBy', '=', Auth::user()->id)->count();
//Rejected
        $mySchemeRejecttoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeRejectyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeRejectThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeRejectlastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeRejectThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeRejectLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeRejectLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeRejectThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
//Activated
        $mySchemeActivetoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeActiveyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeActiveThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeActivelastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeActiveThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeActiveLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeActiveLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemeActiveThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
// Deactivated
        $mySchemePendingtoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemePendingyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemePendingThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemePendinglastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemePendingThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemePendingLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemePendingLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySchemePendingThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
//Rapex Documents
        $myRapextoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexlastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('UploadedBy', '=', Auth::user()->id)->count();
//Rejected
        $myRapexRejecttoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexRejectyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexRejectThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexRejectlastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexRejectThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexRejectLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexRejectLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexRejectThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
//Activated
        $myRapexActivetoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexActiveyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexActiveThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexActivelastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexActiveThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexActiveLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexActiveLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexActiveThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
// Deactivated
        $myRapexPendingtoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexPendingyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexPendingThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexPendinglastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexPendingThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexPendingLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexPendingLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $myRapexPendingThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();

// Service Uganda
        $mySUtoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUlastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySULastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySULastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('UploadedBy', '=', Auth::user()->id)->count();
//Rejected
        $mySURejecttoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySURejectyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySURejectThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySURejectlastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySURejectThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySURejectLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySURejectLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySURejectThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Reject')->where('UploadedBy', '=', Auth::user()->id)->count();
//Activated
        $mySUActivetoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUActiveyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUActiveThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUActivelastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUActiveThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUActiveLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUActiveLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUActiveThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Active')->where('UploadedBy', '=', Auth::user()->id)->count();
// Deactivated
        $mySUPendingtoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUPendingyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUPendingThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUPendinglastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUPendingThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUPendingLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUPendingLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();
        $mySUPendingThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Pending')->where('UploadedBy', '=', Auth::user()->id)->count();

        // admin Statistics

        $Todayz    = Carbon::now()->format('Y-m-d');
        $Yesterday = Carbon::now()->subDays(1)->format('Y-m-d');
        $weekStart = Carbon::now()->startOfWeek()->format('Y-m-d');
        $weekEnd   = Carbon::now()->endOfWeek()->format('Y-m-d');
        $lastweek  = Carbon::now()->startOfWeek()->subDays(7)->format('Y-m-d');
        $past30    = Carbon::today()->subDays(30)->format('Y-m-d');
        $ThisMonth = Carbon::now()->format('m');
        $LastMonth = (Carbon::now()->format('m')) - 1;
        $ThisYear  = (Carbon::now()->format('Y'));
        $LastYear  = (Carbon::now()->format('Y')) - 1;

        $Votestoday     = UserFiles::where('created_at', '>=', $Todayz)->count();
        $Votesyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->count();
        $VotesThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->count();
        $Voteslastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->count();
        $VotesThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->count();
        $VotesLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->count();
        $VotesLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->count();
        $VotesThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->count();
//Rejected
        $VotesRejecttoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', '=', 'Reject')->count();
        $VotesRejectyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Reject')->count();
        $VotesRejectThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Reject')->count();
        $VotesRejectlastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Reject')->count();
        $VotesRejectThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Reject')->count();
        $VotesRejectLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Reject')->count();
        $VotesRejectLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Reject')->count();
        $VotesRejectThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Reject')->count();
//Activated
        $VotesActivetoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', '=', 'Active')->count();
        $VotesActiveyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Active')->count();
        $VotesActiveThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Active')->count();
        $VotesActivelastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Active')->count();
        $VotesActiveThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Active')->count();
        $VotesActiveLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Active')->count();
        $VotesActiveLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Active')->count();
        $VotesActiveThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Active')->count();
// Deactivated
        $VotesPendingtoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', '=', 'Pending')->count();
        $VotesPendingyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Pending')->count();
        $VotesPendingThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Pending')->count();
        $VotesPendinglastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Pending')->count();
        $VotesPendingThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Pending')->count();
        $VotesPendingLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Pending')->count();
        $VotesPendingLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Pending')->count();
        $VotesPendingThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Pending')->count();
// Job Description
        $Jobtoday     = JobDocuments::where('created_at', '>=', $Todayz)->count();
        $Jobyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->count();
        $JobThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->count();
        $Joblastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->count();
        $JobThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->count();
        $JobLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->count();
        $JobLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->count();
        $JobThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->count();
//Rejected
        $JobRejecttoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Reject')->count();
        $JobRejectyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Reject')->count();
        $JobRejectThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Reject')->count();
        $JobRejectlastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Reject')->count();
        $JobRejectThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Reject')->count();
        $JobRejectLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Reject')->count();
        $JobRejectLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Reject')->count();
        $JobRejectThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Reject')->count();
//Activated
        $JobActivetoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Active')->count();
        $JobActiveyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Active')->count();
        $JobActiveThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Active')->count();
        $JobActivelastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Active')->count();
        $JobActiveThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Active')->count();
        $JobActiveLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Active')->count();
        $JobActiveLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Active')->count();
        $JobActiveThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Active')->count();
// Deactivated
        $JobPendingtoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Pending')->count();
        $JobPendingyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Pending')->count();
        $JobPendingThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Pending')->count();
        $JobPendinglastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Pending')->count();
        $JobPendingThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Pending')->count();
        $JobPendingLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Pending')->count();
        $JobPendingLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Pending')->count();
        $JobPendingThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Pending')->count();
// Scheme Of Service
        $Schemetoday     = ServiceScheme::where('created_at', '>=', $Todayz)->count();
        $Schemeyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->count();
        $SchemeThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->count();
        $Schemelastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->count();
        $SchemeThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->count();
        $SchemeLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->count();
        $SchemeLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->count();
        $SchemeThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->count();
//Rejected
        $SchemeRejecttoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 'Reject')->count();
        $SchemeRejectyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Reject')->count();
        $SchemeRejectThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Reject')->count();
        $SchemeRejectlastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Reject')->count();
        $SchemeRejectThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Reject')->count();
        $SchemeRejectLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Reject')->count();
        $SchemeRejectLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Reject')->count();
        $SchemeRejectThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Reject')->count();
//Activated
        $SchemeActivetoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 'Active')->count();
        $SchemeActiveyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Active')->count();
        $SchemeActiveThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Active')->count();
        $SchemeActivelastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Active')->count();
        $SchemeActiveThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Active')->count();
        $SchemeActiveLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Active')->count();
        $SchemeActiveLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Active')->count();
        $SchemeActiveThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Active')->count();
// Deactivated
        $SchemePendingtoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 'Pending')->count();
        $SchemePendingyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Pending')->count();
        $SchemePendingThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Pending')->count();
        $SchemePendinglastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Pending')->count();
        $SchemePendingThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Pending')->count();
        $SchemePendingLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Pending')->count();
        $SchemePendingLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Pending')->count();
        $SchemePendingThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Pending')->count();
//Rapex Documents
        $Rapextoday     = RapexDocuments::where('created_at', '>=', $Todayz)->count();
        $Rapexyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->count();
        $RapexThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->count();
        $Rapexlastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->count();
        $RapexThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->count();
        $RapexLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->count();
        $RapexLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->count();
        $RapexThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->count();
//Rejected
        $RapexRejecttoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Reject')->count();
        $RapexRejectyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Reject')->count();
        $RapexRejectThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Reject')->count();
        $RapexRejectlastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Reject')->count();
        $RapexRejectThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Reject')->count();
        $RapexRejectLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Reject')->count();
        $RapexRejectLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Reject')->count();
        $RapexRejectThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Reject')->count();
//Activated
        $RapexActivetoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Active')->count();
        $RapexActiveyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Active')->count();
        $RapexActiveThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Active')->count();
        $RapexActivelastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Active')->count();
        $RapexActiveThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Active')->count();
        $RapexActiveLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Active')->count();
        $RapexActiveLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Active')->count();
        $RapexActiveThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Active')->count();
// Deactivated
        $RapexPendingtoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 'Pending')->count();
        $RapexPendingyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Pending')->count();
        $RapexPendingThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Pending')->count();
        $RapexPendinglastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Pending')->count();
        $RapexPendingThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Pending')->count();
        $RapexPendingLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Pending')->count();
        $RapexPendingLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Pending')->count();
        $RapexPendingThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Pending')->count();
        //SU Documents
        $SUtoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->count();
        $SUyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->count();
        $SUThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->count();
        $SUlastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->count();
        $SUThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->count();
        $SULastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->count();
        $SULastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->count();
        $SUThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->count();
//Rejected
        $SURejecttoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 'Reject')->count();
        $SURejectyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Reject')->count();
        $SURejectThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Reject')->count();
        $SURejectlastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Reject')->count();
        $SURejectThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Reject')->count();
        $SURejectLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Reject')->count();
        $SURejectLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Reject')->count();
        $SURejectThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Reject')->count();
//Activated
        $SUActivetoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 'Active')->count();
        $SUActiveyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Active')->count();
        $SUActiveThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Active')->count();
        $SUActivelastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Active')->count();
        $SUActiveThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Active')->count();
        $SUActiveLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Active')->count();
        $SUActiveLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Active')->count();
        $SUActiveThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Active')->count();
// Deactivated
        $SUPendingtoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 'Pending')->count();
        $SUPendingyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 'Pending')->count();
        $SUPendingThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 'Pending')->count();
        $SUPendinglastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 'Pending')->count();
        $SUPendingThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 'Pending')->count();
        $SUPendingLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 'Pending')->count();
        $SUPendingLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 'Pending')->count();
        $SUPendingThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 'Pending')->count();

        return view('FileManager.Dashboards.userdashboard',
            compact(
                'myVotestoday', 'myVotesyesterday', 'myVotesThisweek', 'myVoteslastweek', 'myVotesThisMonth', 'myVotesLastMonth', 'myVotesLastYear', 'myVotesThisYear', 'myVotesRejecttoday', 'myVotesRejectyesterday', 'myVotesRejectThisweek', 'myVotesRejectlastweek', 'myVotesRejectThisMonth', 'myVotesRejectLastMonth', 'myVotesRejectLastYear', 'myVotesRejectThisYear', 'myVotesActivetoday', 'myVotesActiveyesterday', 'myVotesActiveThisweek', 'myVotesActivelastweek', 'myVotesActiveThisMonth', 'myVotesActiveLastMonth', 'myVotesActiveLastYear', 'myVotesActiveThisYear', 'myVotesPendingtoday', 'myVotesPendingyesterday', 'myVotesPendingThisweek', 'myVotesPendinglastweek', 'myVotesPendingThisMonth', 'myVotesPendingLastMonth', 'myVotesPendingLastYear', 'myVotesPendingThisYear',
                'myJobtoday', 'myJobyesterday', 'myJobThisweek', 'myJoblastweek', 'myJobThisMonth', 'myJobLastMonth', 'myJobLastYear', 'myJobThisYear', 'myJobRejecttoday', 'myJobRejectyesterday', 'myJobRejectThisweek', 'myJobRejectlastweek', 'myJobRejectThisMonth', 'myJobRejectLastMonth', 'myJobRejectLastYear', 'myJobRejectThisYear', 'myJobActivetoday', 'myJobActiveyesterday', 'myJobActiveThisweek', 'myJobActivelastweek', 'myJobActiveThisMonth', 'myJobActiveLastMonth', 'myJobActiveLastYear', 'myJobActiveThisYear', 'myJobPendingtoday', 'myJobPendingyesterday', 'myJobPendingThisweek', 'myJobPendinglastweek', 'myJobPendingThisMonth', 'myJobPendingLastMonth', 'myJobPendingLastYear', 'myJobPendingThisYear',
                'mySchemetoday', 'mySchemeyesterday', 'mySchemeThisweek', 'mySchemelastweek', 'mySchemeThisMonth', 'mySchemeLastMonth', 'mySchemeLastYear', 'mySchemeThisYear', 'mySchemeRejecttoday', 'mySchemeRejectyesterday', 'mySchemeRejectThisweek', 'mySchemeRejectlastweek', 'mySchemeRejectThisMonth', 'mySchemeRejectLastMonth', 'mySchemeRejectLastYear', 'mySchemeRejectThisYear', 'mySchemeActivetoday', 'mySchemeActiveyesterday', 'mySchemeActiveThisweek', 'mySchemeActivelastweek', 'mySchemeActiveThisMonth', 'mySchemeActiveLastMonth', 'mySchemeActiveLastYear', 'mySchemeActiveThisYear', 'mySchemePendingtoday', 'mySchemePendingyesterday', 'mySchemePendingThisweek', 'mySchemePendinglastweek', 'mySchemePendingThisMonth', 'mySchemePendingLastMonth', 'mySchemePendingLastYear', 'mySchemePendingThisYear',
                'myRapextoday', 'myRapexyesterday', 'myRapexThisweek', 'myRapexlastweek', 'myRapexThisMonth', 'myRapexLastMonth', 'myRapexLastYear', 'myRapexThisYear', 'myRapexRejecttoday', 'myRapexRejectyesterday', 'myRapexRejectThisweek', 'myRapexRejectlastweek', 'myRapexRejectThisMonth', 'myRapexRejectLastMonth', 'myRapexRejectLastYear', 'myRapexRejectThisYear', 'myRapexActivetoday', 'myRapexActiveyesterday', 'myRapexActiveThisweek', 'myRapexActivelastweek', 'myRapexActiveThisMonth', 'myRapexActiveLastMonth', 'myRapexActiveLastYear', 'myRapexActiveThisYear', 'myRapexPendingtoday', 'myRapexPendingyesterday', 'myRapexPendingThisweek', 'myRapexPendinglastweek', 'myRapexPendingThisMonth', 'myRapexPendingLastMonth', 'myRapexPendingLastYear', 'myRapexPendingThisYear',
                'mySUtoday', 'mySUyesterday', 'mySUThisweek', 'mySUlastweek', 'mySUThisMonth', 'mySULastMonth', 'mySULastYear', 'mySUThisYear', 'mySURejecttoday', 'mySURejectyesterday', 'mySURejectThisweek', 'mySURejectlastweek', 'mySURejectThisMonth', 'mySURejectLastMonth', 'mySURejectLastYear', 'mySURejectThisYear', 'mySUActivetoday', 'mySUActiveyesterday', 'mySUActiveThisweek', 'mySUActivelastweek', 'mySUActiveThisMonth', 'mySUActiveLastMonth', 'mySUActiveLastYear', 'mySUActiveThisYear', 'mySUPendingtoday', 'mySUPendingyesterday', 'mySUPendingThisweek', 'mySUPendinglastweek', 'mySUPendingThisMonth', 'mySUPendingLastMonth', 'mySUPendingLastYear', 'mySUPendingThisYear',
                // admin variables
                'Votestoday', 'Votesyesterday', 'VotesThisweek', 'Voteslastweek', 'VotesThisMonth', 'VotesLastMonth', 'VotesLastYear', 'VotesThisYear', 'VotesRejecttoday', 'VotesRejectyesterday', 'VotesRejectThisweek', 'VotesRejectlastweek', 'VotesRejectThisMonth', 'VotesRejectLastMonth', 'VotesRejectLastYear', 'VotesRejectThisYear', 'VotesActivetoday', 'VotesActiveyesterday', 'VotesActiveThisweek', 'VotesActivelastweek', 'VotesActiveThisMonth', 'VotesActiveLastMonth', 'VotesActiveLastYear', 'VotesActiveThisYear', 'VotesPendingtoday', 'VotesPendingyesterday', 'VotesPendingThisweek', 'VotesPendinglastweek', 'VotesPendingThisMonth', 'VotesPendingLastMonth', 'VotesPendingLastYear', 'VotesPendingThisYear',
                'Jobtoday', 'Jobyesterday', 'JobThisweek', 'Joblastweek', 'JobThisMonth', 'JobLastMonth', 'JobLastYear', 'JobThisYear', 'JobRejecttoday', 'JobRejectyesterday', 'JobRejectThisweek', 'JobRejectlastweek', 'JobRejectThisMonth', 'JobRejectLastMonth', 'JobRejectLastYear', 'JobRejectThisYear', 'JobActivetoday', 'JobActiveyesterday', 'JobActiveThisweek', 'JobActivelastweek', 'JobActiveThisMonth', 'JobActiveLastMonth', 'JobActiveLastYear', 'JobActiveThisYear', 'JobPendingtoday', 'JobPendingyesterday', 'JobPendingThisweek', 'JobPendinglastweek', 'JobPendingThisMonth', 'JobPendingLastMonth', 'JobPendingLastYear', 'JobPendingThisYear',
                'Schemetoday', 'Schemeyesterday', 'SchemeThisweek', 'Schemelastweek', 'SchemeThisMonth', 'SchemeLastMonth', 'SchemeLastYear', 'SchemeThisYear', 'SchemeRejecttoday', 'SchemeRejectyesterday', 'SchemeRejectThisweek', 'SchemeRejectlastweek', 'SchemeRejectThisMonth', 'SchemeRejectLastMonth', 'SchemeRejectLastYear', 'SchemeRejectThisYear', 'SchemeActivetoday', 'SchemeActiveyesterday', 'SchemeActiveThisweek', 'SchemeActivelastweek', 'SchemeActiveThisMonth', 'SchemeActiveLastMonth', 'SchemeActiveLastYear', 'SchemeActiveThisYear', 'SchemePendingtoday', 'SchemePendingyesterday', 'SchemePendingThisweek', 'SchemePendinglastweek', 'SchemePendingThisMonth', 'SchemePendingLastMonth', 'SchemePendingLastYear', 'SchemePendingThisYear',
                'Rapextoday', 'Rapexyesterday', 'RapexThisweek', 'Rapexlastweek', 'RapexThisMonth', 'RapexLastMonth', 'RapexLastYear', 'RapexThisYear', 'RapexRejecttoday', 'RapexRejectyesterday', 'RapexRejectThisweek', 'RapexRejectlastweek', 'RapexRejectThisMonth', 'RapexRejectLastMonth', 'RapexRejectLastYear', 'RapexRejectThisYear', 'RapexActivetoday', 'RapexActiveyesterday', 'RapexActiveThisweek', 'RapexActivelastweek', 'RapexActiveThisMonth', 'RapexActiveLastMonth', 'RapexActiveLastYear', 'RapexActiveThisYear', 'RapexPendingtoday', 'RapexPendingyesterday', 'RapexPendingThisweek', 'RapexPendinglastweek', 'RapexPendingThisMonth', 'RapexPendingLastMonth', 'RapexPendingLastYear', 'RapexPendingThisYear',
                'SUtoday', 'SUyesterday', 'SUThisweek', 'SUlastweek', 'SUThisMonth', 'SULastMonth', 'SULastYear', 'SUThisYear', 'SURejecttoday', 'SURejectyesterday', 'SURejectThisweek', 'SURejectlastweek', 'SURejectThisMonth', 'SURejectLastMonth', 'SURejectLastYear', 'SURejectThisYear', 'SUActivetoday', 'SUActiveyesterday', 'SUActiveThisweek', 'SUActivelastweek', 'SUActiveThisMonth', 'SUActiveLastMonth', 'SUActiveLastYear', 'SUActiveThisYear', 'SUPendingtoday', 'SUPendingyesterday', 'SUPendingThisweek', 'SUPendinglastweek', 'SUPendingThisMonth', 'SUPendingLastMonth', 'SUPendingLastYear', 'SUPendingThisYear',
            )
        );
    }
    public function Graphics()
    {

        $user = UserFiles::selectRaw('DATE_FORMAT(created_at,"%M-%Y") as month,sum((status)="Active") as Active,sum((status)="Pending") as Inactive,sum((status)="Reject") as Rejected,count(status) as Total ,DATE_FORMAT(created_at,"%Y-%m") as period')
            ->groupBy('period')
            ->groupBy('month')
            ->orderBy('period', 'asc')
            ->get();
        $data['periods']   = $user->pluck('period');
        $data['inactives'] = $user->pluck('Inactive');
        $data['actives']   = $user->pluck('Active');
        $data['rejects']   = $user->pluck('Rejected');
        $data['totals']    = $user->pluck('Total');
        $data['months']    = $user->pluck('month');
        return view('FileManager.Dashboards.graphics', $data);

    }
}
