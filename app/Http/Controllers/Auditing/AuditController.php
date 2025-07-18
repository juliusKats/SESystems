<?php
namespace App\Http\Controllers\Auditing;

use App\Http\Controllers\Controller;
use App\Models\Questions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Models\Audit;
use Karmendra\LaravelAgentDetector\AgentDetector;

class AuditController extends Controller
{
    //
    public function index(Request $request)
    {
        $audits = Audit::with('user')->orderBy('created_at', 'desc')->get();
        return view('FileManager.AUDIT.auditlog', compact('audits'));

    }
    public function location(Request $request)
    {
        $audits = Audit::with('user')->orderBy('created_at', 'desc')->get();
        return view('FileManager.AUDIT.auditlocation', compact('audits'));

    }
    public function userlist(Request $request)
    {
        $inactiveusers = User::orderBy('created_at', 'desc')->where('status', false)->get();
        $activeusers   = User::orderBy('created_at', 'desc')->where('status', true)->get();
        return view('FileManager.USERS.index', compact('activeusers', 'inactiveusers'));

    }

    public function ActivateUser(Request $request, $id)
    {
        $user        = User::find($id);
        $userid      = $user->id;
        $userstatus  = $user->status;
        $logeduser   = Auth::user()->role;
        $logedid     = Auth::user()->id;
        $logedstatus = Auth::user()->status;
        // dd($logeduser);
        if (($logeduser == "admin" or $logeduser == "superadmin") and $logedstatus == 1) {
            if ($userid != $logedid) {
                if ($userstatus == 1) {
                    $user->status = 0;
                    $user->save();

                    return back()->with('success', 'Line Entity Activate Successfully');
                } else {
                    $user->status = 1;
                    $user->save();

                    return back()->with('success', 'Line Entity Activate Successfully');
                }
            } else {
                return back()->with('error', 'You can not perform this operation on your account');
            }
        } else {
            return back()->with('error', 'Only Activated Admin Can Perform this Operation');
        }

    }

    public function dashboard(Request $request)
    {
        $questions = Questions::where('status', false)->orderBy('created_at', 'desc')->get();
        return view('FileManager.authentication.dashboard', compact('questions'));

    }

}
