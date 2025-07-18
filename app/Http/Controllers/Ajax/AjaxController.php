<?php
namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Institutions;
use App\Models\UserFiles;
use App\Models\VoteDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function TestingChart(Request $request)
    {
        // dd($request->all());
        if ($request->entity == "Establishment") {
            $try = UserFiles::select("VoteName", DB::raw('sum(Approve=1) as Approved'), DB::raw('sum(Approve=0) as Denied'), DB::raw('MONTHNAME(ApprovedON)'))->whereBetween('ApprovedOn', [$request->from, $request->to])->get();
            // $check = UserFiles::select('VoteName',DB::raw('count(Approve)==1 as YES'),DB::raw('count(Approve)==0 as NO'))->where('',$request->entity)->first();
            //  $files['file'] = UserFiles::where('ApprovedOn', '>=',  $request->from )->where('ApprovedOn', '<=', $request->to )->get();
            $files = UserFiles::whereBetween('ApprovedOn', [$request->from, $request->to])->get();
            return response()->json($try);
        } else {
            dd("Not esta");

            // $datas['data'] =UserFiles::where("psApprovedOn", "<=", "{{ $request->from }}" )->get();//->whereDate('created_at', "<", $request->from )->get();

        }
    }
    public function FetchVote(Request $request)
    {
        $votes['vote'] = VoteDetails::all()->where("id", $request->vote_id);
        return response()->json($votes);
    }

    public function FetchInstitution(Request $request)
    {
        $institutes['institute'] = Institutions::where('entity', $request->entity_id)->get();
        return response()->json($institutes);
    }

    public function FetchMultipleInstitution(Request $request)
    {
        $data = $request->all();
        $finalArray=[];
        foreach ($data as $key => $item) {
            $rang   = $data['entities'];
            // $finalinst=Institutions::where('entity', $item)->get(['institution']);
            $itemArray['entities']=$item;
        }

        foreach ($itemArray as $key => $item) {
            $testArray=$item;
        }
        $finalArray=$testArray;
        $finalinst['entity']=Institutions::whereIn('entity', $finalArray)->get(['entity','institution']);
       return response()->json($finalinst);

    }

    public function getGraph(Request $request)
    {
        $votes         = VoteDetails::where('id', $request->vote_id)->first()->votename;
        $establishment = UserFiles::all();
        $active        = $establishment->where('Approve', true)->where('VoteCode', $request->vote_id)->count();
        $inactive      = $establishment->where('Approve', false)->where('VoteCode', $request->vote_id)->count();
        // $final         = DB::table('user_files')->select('vote_details.votecode', 'vote_details.votename', 'user_files.Approve',
        //     DB::raw('COUNT((user_files.Approve)=1) as Active'),DB::raw('COUNT((user_files.Approve)=0) as Inactive'))
        // ->join('vote_details','vote_details.id','=','user_files.VoteCode')
        // ->where('user_files.VoteCode',$request->vote_id)
        // ->groupBy('user_files.Approve','vote_details.votename')
        // ->get();
        $final = UserFiles::select('vote_details.votecode', 'vote_details.votename', 'user_files.Approve',
            DB::raw('COUNT((user_files.Approve)=1) as Active'), DB::raw('COUNT((user_files.Approve)=0) as Inactive'))
            ->join('vote_details', 'vote_details.id', '=', 'user_files.VoteCode')
            ->where('user_files.VoteCode', $request->vote_id)
            ->groupBy('user_files.Approve', 'vote_details.votename')
            ->get(['vote_details.votename', 'Active', 'Inactive']);

        return response()->json(compact('final', 'votes', 'active', 'inactive'));
    }

}

// ,,'COUNT("user_files.Approve"),false AS Inactive'

// SELECT vote_details.id','vote_details.votecode',' vote_details.votename ',' user_files.VoteName',' user_files.comment',' user_files.Approve',' user_files.excelOriginal',' user_files.excelfile',' user_files.excelsize',' user_files.pdfOriginal',' user_files.pdffile',' user_files.pdfsize',' user_files.psApprovedOn',' user_files.ApprovedOn',' user_files.UploadedBy',' user_files.ApprovedBy',' user_files.approved_by',' user_files.UploadedOn',' user_files.created_at',' user_files.updated_at',' user_files.UpdatedBy','
// COUNT(user_files.Approve) =1 AS Active','COUNT(user_files.Approve) =0 AS Inactive
// FROM user_files JOIN vote_details ON vote_details.id=user_files.VoteCode
