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
        $myVotestoday     = UserFiles::where('created_at', '>=', $Todayz)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVoteslastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
//Rejected
        $myVotesRejecttoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesRejectyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesRejectThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesRejectlastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesRejectThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesRejectLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesRejectLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesRejectThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
//Activated
        $myVotesActivetoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesActiveyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesActiveThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesActivelastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesActiveThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesActiveLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesActiveLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesActiveThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
// Deactivated
        $myVotesPendingtoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesPendingyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesPendingThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesPendinglastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesPendingThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesPendingLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesPendingLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myVotesPendingThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
// Job Description
        $myJobtoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJoblastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
//Rejected
        $myJobRejecttoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobRejectyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobRejectThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobRejectlastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobRejectThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobRejectLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobRejectLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobRejectThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
//Activated
        $myJobActivetoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobActiveyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobActiveThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobActivelastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobActiveThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobActiveLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobActiveLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobActiveThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
// Deactivated
        $myJobPendingtoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobPendingyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobPendingThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobPendinglastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobPendingThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobPendingLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobPendingLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myJobPendingThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
// Scheme Of Service
        $mySchemetoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemelastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
//Rejected
        $mySchemeRejecttoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeRejectyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeRejectThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeRejectlastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeRejectThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeRejectLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeRejectLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeRejectThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
//Activated
        $mySchemeActivetoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeActiveyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeActiveThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeActivelastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeActiveThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeActiveLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeActiveLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemeActiveThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
// Deactivated
        $mySchemePendingtoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemePendingyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemePendingThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemePendinglastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemePendingThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemePendingLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemePendingLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySchemePendingThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
//Rapex Documents
        $myRapextoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexlastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
//Rejected
        $myRapexRejecttoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexRejectyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexRejectThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexRejectlastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexRejectThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexRejectLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexRejectLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexRejectThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
//Activated
        $myRapexActivetoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexActiveyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexActiveThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexActivelastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexActiveThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexActiveLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexActiveLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexActiveThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
// Deactivated
        $myRapexPendingtoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexPendingyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexPendingThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexPendinglastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexPendingThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexPendingLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexPendingLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $myRapexPendingThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();

// Service Uganda
        $mySUtoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUlastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySULastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySULastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
//Rejected
        $mySURejecttoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySURejectyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySURejectThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySURejectlastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySURejectThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySURejectLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySURejectLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySURejectThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 4)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
//Activated
        $mySUActivetoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUActiveyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUActiveThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUActivelastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUActiveThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUActiveLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUActiveLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUActiveThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 3)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
// Deactivated
        $mySUPendingtoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUPendingyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUPendingThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUPendinglastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUPendingThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUPendingLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUPendingLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();
        $mySUPendingThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 2)->where('UploadedBy', '=', Auth::user()->id)->where('Draft',0)->count();

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

        $Votestoday     = UserFiles::where('created_at', '>=', $Todayz)->where('Draft',0)->count();
        $Votesyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('Draft',0)->count();
        $VotesThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('Draft',0)->count();
        $Voteslastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('Draft',0)->count();
        $VotesThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('Draft',0)->count();
        $VotesLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('Draft',0)->count();
        $VotesLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('Draft',0)->count();
        $VotesThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('Draft',0)->count();
//Rejected
        $VotesRejecttoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', '=', 4)->where('Draft',0)->count();
        $VotesRejectyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 4)->where('Draft',0)->count();
        $VotesRejectThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 4)->where('Draft',0)->count();
        $VotesRejectlastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 4)->where('Draft',0)->count();
        $VotesRejectThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 4)->where('Draft',0)->count();
        $VotesRejectLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 4)->where('Draft',0)->count();
        $VotesRejectLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 4)->where('Draft',0)->count();
        $VotesRejectThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 4)->where('Draft',0)->count();
//Activated
        $VotesActivetoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', '=', 3)->where('Draft',0)->count();
        $VotesActiveyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 3)->where('Draft',0)->count();
        $VotesActiveThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 3)->where('Draft',0)->count();
        $VotesActivelastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 3)->where('Draft',0)->count();
        $VotesActiveThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 3)->where('Draft',0)->count();
        $VotesActiveLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 3)->where('Draft',0)->count();
        $VotesActiveLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 3)->where('Draft',0)->count();
        $VotesActiveThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 3)->where('Draft',0)->count();
// Deactivated
        $VotesPendingtoday     = UserFiles::where('created_at', '>=', $Todayz)->where('status', 2)->where('Draft',0)->count();
        $VotesPendingyesterday = UserFiles::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 2)->where('Draft',0)->count();
        $VotesPendingThisweek  = UserFiles::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 2)->where('Draft',0)->count();
        $VotesPendinglastweek  = UserFiles::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 2)->where('Draft',0)->count();
        $VotesPendingThisMonth = UserFiles::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 2)->where('Draft',0)->count();
        $VotesPendingLastMonth = UserFiles::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 2)->where('Draft',0)->count();
        $VotesPendingLastYear  = UserFiles::whereYear('created_at', '=', $LastYear)->where('status', '=', 2)->where('Draft',0)->count();
        $VotesPendingThisYear  = UserFiles::whereYear('created_at', '=', $ThisYear)->where('status', '=', 2)->where('Draft',0)->count();
// Job Description
        $Jobtoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('Draft',0)->count();
        $Jobyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('Draft',0)->count();
        $JobThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('Draft',0)->count();
        $Joblastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('Draft',0)->count();
        $JobThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('Draft',0)->count();
        $JobLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('Draft',0)->count();
        $JobLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('Draft',0)->count();
        $JobThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('Draft',0)->count();
//Rejected
        $JobRejecttoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 4)->where('Draft',0)->count();
        $JobRejectyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 4)->where('Draft',0)->count();
        $JobRejectThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 4)->where('Draft',0)->count();
        $JobRejectlastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 4)->where('Draft',0)->count();
        $JobRejectThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 4)->where('Draft',0)->count();
        $JobRejectLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 4)->where('Draft',0)->count();
        $JobRejectLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 4)->where('Draft',0)->count();
        $JobRejectThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 4)->where('Draft',0)->count();
//Activated
        $JobActivetoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 3)->where('Draft',0)->count();
        $JobActiveyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 3)->where('Draft',0)->count();
        $JobActiveThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 3)->where('Draft',0)->count();
        $JobActivelastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 3)->where('Draft',0)->count();
        $JobActiveThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 3)->where('Draft',0)->count();
        $JobActiveLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 3)->where('Draft',0)->count();
        $JobActiveLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 3)->where('Draft',0)->count();
        $JobActiveThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 3)->where('Draft',0)->count();
// Deactivated
        $JobPendingtoday     = JobDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 2)->where('Draft',0)->count();
        $JobPendingyesterday = JobDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 2)->where('Draft',0)->count();
        $JobPendingThisweek  = JobDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 2)->where('Draft',0)->count();
        $JobPendinglastweek  = JobDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 2)->where('Draft',0)->count();
        $JobPendingThisMonth = JobDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 2)->where('Draft',0)->count();
        $JobPendingLastMonth = JobDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 2)->where('Draft',0)->count();
        $JobPendingLastYear  = JobDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 2)->where('Draft',0)->count();
        $JobPendingThisYear  = JobDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 2)->where('Draft',0)->count();
// Scheme Of Service
        $Schemetoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('Draft',0)->count();
        $Schemeyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('Draft',0)->count();
        $SchemeThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('Draft',0)->count();
        $Schemelastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('Draft',0)->count();
        $SchemeThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('Draft',0)->count();
        $SchemeLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('Draft',0)->count();
        $SchemeLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('Draft',0)->count();
        $SchemeThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('Draft',0)->count();
//Rejected
        $SchemeRejecttoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 4)->where('Draft',0)->count();
        $SchemeRejectyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 4)->where('Draft',0)->count();
        $SchemeRejectThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 4)->where('Draft',0)->count();
        $SchemeRejectlastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 4)->where('Draft',0)->count();
        $SchemeRejectThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 4)->where('Draft',0)->count();
        $SchemeRejectLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 4)->where('Draft',0)->count();
        $SchemeRejectLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 4)->where('Draft',0)->count();
        $SchemeRejectThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 4)->where('Draft',0)->count();
//Activated
        $SchemeActivetoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 3)->where('Draft',0)->count();
        $SchemeActiveyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 3)->where('Draft',0)->count();
        $SchemeActiveThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 3)->where('Draft',0)->count();
        $SchemeActivelastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 3)->where('Draft',0)->count();
        $SchemeActiveThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 3)->where('Draft',0)->count();
        $SchemeActiveLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 3)->where('Draft',0)->count();
        $SchemeActiveLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 3)->where('Draft',0)->count();
        $SchemeActiveThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 3)->where('Draft',0)->count();
// Deactivated
        $SchemePendingtoday     = ServiceScheme::where('created_at', '>=', $Todayz)->where('status', '=', 2)->where('Draft',0)->count();
        $SchemePendingyesterday = ServiceScheme::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 2)->where('Draft',0)->count();
        $SchemePendingThisweek  = ServiceScheme::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 2)->where('Draft',0)->count();
        $SchemePendinglastweek  = ServiceScheme::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 2)->where('Draft',0)->count();
        $SchemePendingThisMonth = ServiceScheme::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 2)->where('Draft',0)->count();
        $SchemePendingLastMonth = ServiceScheme::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 2)->where('Draft',0)->count();
        $SchemePendingLastYear  = ServiceScheme::whereYear('created_at', '=', $LastYear)->where('status', '=', 2)->where('Draft',0)->count();
        $SchemePendingThisYear  = ServiceScheme::whereYear('created_at', '=', $ThisYear)->where('status', '=', 2)->where('Draft',0)->count();
//Rapex Documents
        $Rapextoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('Draft',0)->count();
        $Rapexyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('Draft',0)->count();
        $RapexThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('Draft',0)->count();
        $Rapexlastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('Draft',0)->count();
        $RapexThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('Draft',0)->count();
        $RapexLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('Draft',0)->count();
        $RapexLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('Draft',0)->count();
        $RapexThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('Draft',0)->count();
//Rejected
        $RapexRejecttoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 4)->where('Draft',0)->count();
        $RapexRejectyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 4)->where('Draft',0)->count();
        $RapexRejectThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 4)->where('Draft',0)->count();
        $RapexRejectlastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 4)->where('Draft',0)->count();
        $RapexRejectThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 4)->where('Draft',0)->count();
        $RapexRejectLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 4)->where('Draft',0)->count();
        $RapexRejectLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 4)->where('Draft',0)->count();
        $RapexRejectThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 4)->where('Draft',0)->count();
//Activated
        $RapexActivetoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 3)->where('Draft',0)->count();
        $RapexActiveyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 3)->where('Draft',0)->count();
        $RapexActiveThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 3)->where('Draft',0)->count();
        $RapexActivelastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 3)->where('Draft',0)->count();
        $RapexActiveThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 3)->where('Draft',0)->count();
        $RapexActiveLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 3)->where('Draft',0)->count();
        $RapexActiveLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 3)->where('Draft',0)->count();
        $RapexActiveThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 3)->where('Draft',0)->count();
// Deactivated
        $RapexPendingtoday     = RapexDocuments::where('created_at', '>=', $Todayz)->where('status', '=', 2)->where('Draft',0)->count();
        $RapexPendingyesterday = RapexDocuments::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 2)->where('Draft',0)->count();
        $RapexPendingThisweek  = RapexDocuments::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 2)->where('Draft',0)->count();
        $RapexPendinglastweek  = RapexDocuments::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 2)->where('Draft',0)->count();
        $RapexPendingThisMonth = RapexDocuments::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 2)->where('Draft',0)->count();
        $RapexPendingLastMonth = RapexDocuments::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 2)->where('Draft',0)->count();
        $RapexPendingLastYear  = RapexDocuments::whereYear('created_at', '=', $LastYear)->where('status', '=', 2)->where('Draft',0)->count();
        $RapexPendingThisYear  = RapexDocuments::whereYear('created_at', '=', $ThisYear)->where('status', '=', 2)->where('Draft',0)->count();
        //SU Documents
        $SUtoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('Draft',0)->count();
        $SUyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('Draft',0)->count();
        $SUThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('Draft',0)->count();
        $SUlastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('Draft',0)->count();
        $SUThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('Draft',0)->count();
        $SULastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('Draft',0)->count();
        $SULastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('Draft',0)->count();
        $SUThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('Draft',0)->count();
//Rejected
        $SURejecttoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 4)->where('Draft',0)->count();
        $SURejectyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 4)->where('Draft',0)->count();
        $SURejectThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 4)->where('Draft',0)->count();
        $SURejectlastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 4)->where('Draft',0)->count();
        $SURejectThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 4)->where('Draft',0)->count();
        $SURejectLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 4)->where('Draft',0)->count();
        $SURejectLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 4)->where('Draft',0)->count();
        $SURejectThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 4)->where('Draft',0)->count();
//Activated
        $SUActivetoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 3)->where('Draft',0)->count();
        $SUActiveyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 3)->where('Draft',0)->count();
        $SUActiveThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 3)->where('Draft',0)->count();
        $SUActivelastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 3)->where('Draft',0)->count();
        $SUActiveThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 3)->where('Draft',0)->count();
        $SUActiveLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 3)->where('Draft',0)->count();
        $SUActiveLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 3)->where('Draft',0)->count();
        $SUActiveThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 3)->where('Draft',0)->count();
// Deactivated
        $SUPendingtoday     = ServiceUgandaCenter::where('created_at', '>=', $Todayz)->where('status', '=', 2)->where('Draft',0)->count();
        $SUPendingyesterday = ServiceUgandaCenter::whereDate('created_at', '>=', $Yesterday)->whereDate('created_at', '<=', $Yesterday)->where('status', '=', 2)->where('Draft',0)->count();
        $SUPendingThisweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $weekStart)->whereDate('created_at', '<=', $weekEnd)->where('status', '=', 2)->where('Draft',0)->count();
        $SUPendinglastweek  = ServiceUgandaCenter::whereDate('created_at', '>=', $lastweek)->whereDate('created_at', '<=', $weekStart)->where('status', '=', 2)->where('Draft',0)->count();
        $SUPendingThisMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $ThisMonth)->where('status', '=', 2)->where('Draft',0)->count();
        $SUPendingLastMonth = ServiceUgandaCenter::whereMonth('created_at', '=', $LastMonth)->where('status', '=', 2)->where('Draft',0)->count();
        $SUPendingLastYear  = ServiceUgandaCenter::whereYear('created_at', '=', $LastYear)->where('status', '=', 2)->where('Draft',0)->count();
        $SUPendingThisYear  = ServiceUgandaCenter::whereYear('created_at', '=', $ThisYear)->where('status', '=', 2)->where('Draft',0)->count();

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

        $user = UserFiles::selectRaw('DATE_FORMAT(created_at,"%M-%Y") as month,sum((status)="3") as Active,sum((status)="2") as Inactive,sum((status)="4") as Rejected,count(status) as Total ,DATE_FORMAT(created_at,"%Y-%m") as period')
        ->where('Draft',0)
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
