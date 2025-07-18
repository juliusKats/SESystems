<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\UserFiles;
use App\Models\VoteDetails;
use Carbon\Carbon;
use iamfarhad\LaravelAuditLog\Models\EloquentAuditLog;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        //
        // $log= EloquentAuditLog::forEntity(VoteDetails::class)->orderBy("created_at","desc")->fromHttp()->get();
        $activevotes=VoteDetails::orderBy('updated_at','desc')->where('Active',true)->get();
        $inactivevotes=VoteDetails::orderBy('updated_at','desc')->where('Active',false)->get();
        return view('FileManager.SETUP.VOTES.index', compact('activevotes','inactivevotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        return view('FileManager.SETUP.VOTES.add');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'votecode' => 'required|string|min:3|max:3|unique:vote_details,votecode',
             'votename' => 'required|string|max:50',
            'status' => 'required',
        ]);
        $countcodes=VoteDetails::where('votecode',$request->votecode)->count();
        if($countcodes> 0){
            return back()->with('error','vote with the code already exists');
        }else{
            $vote =VoteDetails::create([
                'votecode'=>$request->votecode,
                'votename'=>$request->votename,
                'Active'=>$request->status
            ]);
            return redirect()->route('vote.list')->with('success','Vote created Success fully');
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
    public function destroy(Request $request, $id)
    {
        $vote = VoteDetails::find($id);
        $vote->delete();
        return redirect()->route('vote.list')->with('success','Vote Successfully Deleted');
    }

    public function changeStatus(Request $request, $id){
        $vote=VoteDetails::find($id);
        $status=$vote->Active;
        // dd($status);
        if($status ==1){
            $vote->Active = false;
            $vote->updated_at = Carbon::now();
            $vote->save();
            return redirect()->route('vote.list')->with('success','Vote De-activated');
        }
        else{
            $vote->Active = true;
            $vote->updated_at = Carbon::now();
            $vote->save();
            return redirect()->route('vote.list')->with('success','Vote Activated');
        }
    }
}
