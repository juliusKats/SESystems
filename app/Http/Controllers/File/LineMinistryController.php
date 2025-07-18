<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\GovEntities;
use App\Models\Institutions;
use Illuminate\Http\Request;

class LineMinistryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function LineIndex(Request $request)
    {
        $linesActive=GovEntities::orderBy("created_at","desc")->where('status',true)->get();
        $linesInactive=GovEntities::orderBy("created_at","desc")->where('status',false)->get();
        return view("FileManager.SETUP.LINE.index" ,compact('linesActive','linesInactive'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function LineStore(Request $request)
    {
        // dd("Hi");
        $validatedData = $request->validate([
            'linename'=> 'required|string|min:5,unique:gov_entities,entityName',
        ]);
        if($validatedData){
            GovEntities::create([
                'entityName'=> $validatedData['linename'],
                'status'=>false
            ]);
             return redirect()->route('line.ministy.list')->with('success','Line Ministry Successfully added');
        }
         return redirect()->route('line.ministy.list')->with('error','Something went wrong');
    }

    /**
     * Display the specified resource.
     */
    public function Lineshow(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function Lineedit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function Lineupdate(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function Linedestroy(Request $request, $id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function InstitutionIndex()
    {

        $instituteActive=Institutions::select('institutions.id', 'gov_entities.entityName', 'institutions.institution', 'institutions.status',  'institutions.updated_at')
        ->join('gov_entities', 'gov_entities.id', '=', 'institutions.entity')
        ->orderBy('institutions.updated_at',"desc")
        ->where('institutions.status',true)->get();
        $instituteInactive=Institutions::select('institutions.id', 'gov_entities.entityName', 'institutions.institution', 'institutions.status',  'institutions.updated_at')
        ->join('gov_entities', 'gov_entities.id', '=', 'institutions.entity')
        ->orderBy('institutions.updated_at',"desc")
        ->where('institutions.status',false)->get();
        return view("FileManager.SETUP.INSTITUTION.index",compact('instituteActive','instituteInactive') );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function Institutioncreate()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function InstitutionStore(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function Institutionshow(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function Institutionedit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function Institutionupdate(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function Institutiondestroy(Request $request, $id)
    {
        //
    }


    public function LineActivate(Request $request,$id){
        $line = GovEntities::find($id);
        $linestatus=$line->status;
        if($linestatus== 1){
            $line->status= 0;
            $line->save();
            return back()->with('success','Line Entity Activate Successfully');
        }
        else{
            $line->status= 1;
            $line->save();

            return back()->with('success','Line Entity Activate Successfully');
        }
    }

    public function InstituteActivate(Request $request,$id){
        $line = Institutions::find($id);
        $linestatus=$line->status;
        if($linestatus== 1){
            $line->status= 0;
            $line->save();
            return back()->with('success','Line Entity Activate Successfully');
        }
        else{
            $line->status= 1;
            $line->save();

            return back()->with('success','Line Entity Activate Successfully');
        }
    }
}
