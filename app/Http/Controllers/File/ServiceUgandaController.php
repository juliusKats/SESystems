<?php
namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\ImageCategory;
use App\Models\ServiceCenter;
use App\Models\ServiceUgandaCenter;
use App\Models\SUImages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ServiceUgandaController extends Controller
{
    //
    public function index(Request $request)
    {
        $allactive = DB::table('service_uganda_centers')->select
        ('service_uganda_centers.id', 'service_uganda_centers.SUCenter', 'service_uganda_centers.file', 'service_uganda_centers.comment', 'service_uganda_centers.zoomlink', 'service_uganda_centers.updated_at', 'service_uganda_centers.created_at', 'service_uganda_centers.deleted_at', 'service_uganda_centers.DeletedBy', 'service_uganda_centers.RestoredBy', 'service_uganda_centers.UploadedOn', 'service_uganda_centers.UploadedBy', 'service_uganda_centers.ApprovedBy', 'service_uganda_centers.UpdatedBy', 'service_uganda_centers.approved_by', 'doc_statuses.statusName', 'service_uganda_centers.DateOn', 'service_uganda_centers.RejectedBy', 'service_uganda_centers.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'service_uganda_centers.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'service_uganda_centers.status')
            ->where('service_uganda_centers.status', 3)
            ->where('service_uganda_centers.Draft', false)
            ->get();
        $allpending = DB::table('service_uganda_centers')->select
        ('service_uganda_centers.id', 'service_uganda_centers.SUCenter', 'service_uganda_centers.file', 'service_uganda_centers.comment', 'service_uganda_centers.zoomlink', 'service_uganda_centers.updated_at', 'service_uganda_centers.created_at', 'service_uganda_centers.deleted_at', 'service_uganda_centers.DeletedBy', 'service_uganda_centers.RestoredBy', 'service_uganda_centers.UploadedOn', 'service_uganda_centers.UploadedBy', 'service_uganda_centers.ApprovedBy', 'service_uganda_centers.UpdatedBy', 'service_uganda_centers.approved_by', 'doc_statuses.statusName', 'service_uganda_centers.DateOn', 'service_uganda_centers.RejectedBy', 'service_uganda_centers.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'service_uganda_centers.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'service_uganda_centers.status')
            ->where('service_uganda_centers.status', 2)
            ->where('service_uganda_centers.Draft', false)
            ->get();

        $allrejected = DB::table('service_uganda_centers')->select
        ('service_uganda_centers.id', 'service_uganda_centers.SUCenter', 'service_uganda_centers.file', 'service_uganda_centers.comment', 'service_uganda_centers.zoomlink', 'service_uganda_centers.updated_at', 'service_uganda_centers.created_at', 'service_uganda_centers.deleted_at', 'service_uganda_centers.DeletedBy', 'service_uganda_centers.RestoredBy', 'service_uganda_centers.UploadedOn', 'service_uganda_centers.UploadedBy', 'service_uganda_centers.ApprovedBy', 'service_uganda_centers.UpdatedBy', 'service_uganda_centers.approved_by', 'doc_statuses.statusName', 'service_uganda_centers.DateOn', 'service_uganda_centers.RejectedBy', 'service_uganda_centers.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'service_uganda_centers.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'service_uganda_centers.status')
            ->where('service_uganda_centers.status', 4)
            ->where('service_uganda_centers.Draft', false)
            ->get();

        $alldeleted = ServiceUgandaCenter::onlyTrashed()->select
        ('service_uganda_centers.id', 'service_uganda_centers.SUCenter', 'service_uganda_centers.file', 'service_uganda_centers.comment', 'service_uganda_centers.zoomlink', 'service_uganda_centers.updated_at', 'service_uganda_centers.created_at', 'service_uganda_centers.deleted_at', 'service_uganda_centers.DeletedBy', 'service_uganda_centers.RestoredBy', 'service_uganda_centers.UploadedOn', 'service_uganda_centers.UploadedBy', 'service_uganda_centers.ApprovedBy', 'service_uganda_centers.UpdatedBy', 'service_uganda_centers.approved_by', 'doc_statuses.statusName', 'service_uganda_centers.DateOn', 'service_uganda_centers.RejectedBy', 'service_uganda_centers.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'service_uganda_centers.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'service_uganda_centers.status')
            ->where('service_uganda_centers.status', 5)
            ->where('service_uganda_centers.Draft', false)
            ->get();
        $mypending = DB::table('service_uganda_centers')->select
        ('service_uganda_centers.id', 'service_uganda_centers.SUCenter', 'service_uganda_centers.file', 'service_uganda_centers.comment', 'service_uganda_centers.zoomlink', 'service_uganda_centers.updated_at', 'service_uganda_centers.created_at', 'service_uganda_centers.deleted_at', 'service_uganda_centers.DeletedBy', 'service_uganda_centers.RestoredBy', 'service_uganda_centers.UploadedOn', 'service_uganda_centers.UploadedBy', 'service_uganda_centers.ApprovedBy', 'service_uganda_centers.UpdatedBy', 'service_uganda_centers.approved_by', 'doc_statuses.statusName', 'service_uganda_centers.DateOn', 'service_uganda_centers.RejectedBy', 'service_uganda_centers.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'service_uganda_centers.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'service_uganda_centers.status')
            ->where('service_uganda_centers.status', 2)
            ->where('service_uganda_centers.Draft', false)
            ->where('service_uganda_centers.UploadedBy', Auth::user()->id)
            ->get();

        $myrejected = DB::table('service_uganda_centers')->select
        ('service_uganda_centers.id', 'service_uganda_centers.SUCenter', 'service_uganda_centers.file', 'service_uganda_centers.comment', 'service_uganda_centers.zoomlink', 'service_uganda_centers.updated_at', 'service_uganda_centers.created_at', 'service_uganda_centers.deleted_at', 'service_uganda_centers.DeletedBy', 'service_uganda_centers.RestoredBy', 'service_uganda_centers.UploadedOn', 'service_uganda_centers.UploadedBy', 'service_uganda_centers.ApprovedBy', 'service_uganda_centers.UpdatedBy', 'service_uganda_centers.approved_by', 'doc_statuses.statusName', 'service_uganda_centers.DateOn', 'service_uganda_centers.RejectedBy', 'service_uganda_centers.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'service_uganda_centers.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'service_uganda_centers.status')
            ->where('service_uganda_centers.status', 4)
            ->where('service_uganda_centers.Draft', false)
            ->where('service_uganda_centers.UploadedBy', Auth::user()->id)
            ->get();

        $mydeleted = ServiceUgandaCenter::onlyTrashed()->select
        ('service_uganda_centers.id', 'service_uganda_centers.SUCenter', 'service_uganda_centers.file', 'service_uganda_centers.comment', 'service_uganda_centers.zoomlink', 'service_uganda_centers.updated_at', 'service_uganda_centers.created_at', 'service_uganda_centers.deleted_at', 'service_uganda_centers.DeletedBy', 'service_uganda_centers.RestoredBy', 'service_uganda_centers.UploadedOn', 'service_uganda_centers.UploadedBy', 'service_uganda_centers.ApprovedBy', 'service_uganda_centers.UpdatedBy', 'service_uganda_centers.approved_by', 'doc_statuses.statusName', 'service_uganda_centers.DateOn', 'service_uganda_centers.RejectedBy', 'service_uganda_centers.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'service_uganda_centers.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'service_uganda_centers.status')
            ->where('service_uganda_centers.status', 5)
            ->where('service_uganda_centers.UploadedBy', Auth::user()->id)
            ->get();

        $mydrafts = DB::table('service_uganda_centers')->select
        ('service_uganda_centers.id', 'service_uganda_centers.SUCenter', 'service_uganda_centers.file', 'service_uganda_centers.comment', 'service_uganda_centers.zoomlink', 'service_uganda_centers.updated_at', 'service_uganda_centers.created_at', 'service_uganda_centers.deleted_at', 'service_uganda_centers.DeletedBy', 'service_uganda_centers.RestoredBy', 'service_uganda_centers.UploadedOn', 'service_uganda_centers.UploadedBy', 'service_uganda_centers.ApprovedBy', 'service_uganda_centers.UpdatedBy', 'service_uganda_centers.approved_by', 'doc_statuses.statusName', 'service_uganda_centers.DateOn', 'service_uganda_centers.RejectedBy', 'service_uganda_centers.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'service_uganda_centers.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'service_uganda_centers.status')
            ->where('service_uganda_centers.Draft', true)
            ->where('service_uganda_centers.UploadedBy', Auth::user()->id)
            ->get();

        return view("FileManager.ServiceUg.index", compact('allactive', 'allpending', 'allrejected', 'alldeleted',
            'mypending', 'myrejected', 'mydeleted', 'mydrafts'));
    }
    public function create(Request $request)
    {
        $entities   = ServiceCenter::all();
        $categories = ImageCategory::all();
        return view("FileManager.ServiceUg.add", compact("entities", 'categories'));

    }
    public function store(Request $request)
    {
        // dd($request->all());
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin') {
            $status = 3;
        } else {
            $status = 2;
        }
        $year  = date("Y");
        $month = date("M");
        $date  = Carbon::now();
        $datef = $date->format("d_M_Y_") . time() . "_";

        $rapexpath = 'SU/' . $year . "/" . $month;
        $data      = $request->validate([
            'entity'      => 'required',
            'entity.*'    => 'required',
            'docs'        => 'required',
            'docs.*'      => 'required|mimes:docx,doc,pdf,xls,xlsx|max:4094',
            'images'      => 'nullable',
            'images.*'    => 'nullable|mimes:png,jpg,jpg|max:4094',
            'link'        => 'nullable|url',
            'comment'     => 'string|required|min:5',
            'video'       => 'nullable|file|mimes:avi,divx,flv,m4v,mkv,mov,mp4,mpeg,mpg,ogm,ogv,ogx,rm,rmvb,smil,webm,wmv,xvid',
            'categrory'   => 'required_if:images,!=null|exists:image_categories,id',
            'description' => 'required_if:images,!=null',
        ]);
        // dd($data);

        // validate comment
        $dom = new \DomDocument();
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
        $rapexcomment = $dom->saveHTML();
        $entity       = $request->entity;
        $institute    = $request->institute;
        $entityID     = [];

        foreach ($entity as $key => $value) {
            $idArray[] = $value;
        }
        $entityID = implode(",", $idArray);

        $documentArray = [];
        $pictureArray  = [];

        if ($request->hasFile('docs')) {
            // $allowedextensions=['pdf','doc','docx','xls','xlsx','png','jpg','jpeg'];
            $files = $request->file('docs');
            foreach ($files as $file) {
                $originalFileName = $file->getClientOriginalName();
                $filename         = $datef . $originalFileName;
                $ppath            = $file->move(public_path('storage/' . $rapexpath), $filename);
                $docArray[]       = $filename;

            }
            $documentArray = implode(",", $docArray);

        }
        if ($request->hasFile('images')) {
            // $allowedextensions=['pdf','doc','docx','xls','xlsx','png','jpg','jpeg'];
            $img = $request->file('images');
            foreach ($img as $image) {
                $originalImageName = $image->getClientOriginalName();
                $imagename         = $datef . $originalImageName;

                $imgpath    = $image->move(public_path('storage/gallery/RAPEX'), $imagename);
                $imgArray[] = $imagename;

            }
            $pictureArray = implode(",", $imgArray);
        }

        if ($request->hasFile('video')) {
            $video        = $request->file('video');
            $videoname    = $video->getClientOriginalName();
            $videoNewName = $year . "_" . $month . "_" . $videoname;
            $videopath    = $video->move(public_path('storage/Rapex/Video/' . $year . "/" . $month), $videoNewName);
        }
        if ($request->save) {

            $rpdoc = ServiceUgandaCenter::create([
                'SUCenter'   => $entityID,
                'file'       => $documentArray,
                'comment'    => $rapexcomment,
                'status'     => $status,
                'zoomlink'   => $request->link,
                'UploadedBy' => Auth::user()->id,
            ]);
        } else {
            $rpdoc = ServiceUgandaCenter::create([
                'SUCenter'   => $entityID,
                'file'       => $documentArray,
                'comment'    => $rapexcomment,
                'status'     => $status,
                'zoomlink'   => $request->link,
                'Draft'      => true,
                'UploadedBy' => Auth::user()->id,
            ]);

        }

        // if ($pictureArray != "" or $pictureArray != null) {
        if ($request->hasFile('images') != null && $rpdoc) {
            SUImages::create([
                'uploadedby'  => Auth::user()->id,
                'rapex_id'    => $rpdoc->id,
                'imagefiles'  => $pictureArray,
                'category_id' => $request->category,
                'Description' => $request->description,
            ]);
        }

        return redirect()->route('su.file.list')->with('success', 'Files uploaded Successfully');
    }

    public function Approve(Request $request, $id)
    {
        $file   = ServiceUgandaCenter::findOrFail($id);
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
            return redirect()->route('su.file.list')->with('success', 'file De-activated');
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
            return redirect()->route('scheme.service.list')->with('success', 'Vote Activated');
        }
    }
    public function Reject(Request $request, $id)
    {
        $Rapex = ServiceUgandaCenter::findOrFail($id);
        $file  = ServiceUgandaCenter::select
        ('rapex_documents.id', 'rapex_documents.entity', 'rapex_documents.institution', 'rapex_documents.file', 'rapex_documents.comment', 'rapex_documents.zoomlink', 'rapex_documents.updated_at', 'rapex_documents.created_at', 'rapex_documents.deleted_at', 'rapex_documents.DeletedBy', 'rapex_documents.RestoredBy', 'rapex_documents.UploadedOn', 'rapex_documents.UploadedBy', 'rapex_documents.ApprovedBy', 'rapex_documents.UpdatedBy', 'rapex_documents.approved_by', 'doc_statuses.statusName', 'rapex_documents.DateOn', 'rapex_documents.RejectedBy', 'rapex_documents.Reason', 'users.fname', 'users.oname', 'users.sname')
            ->join('users', 'users.id', '=', 'rapex_documents.UploadedBy')
            ->join('doc_statuses', 'doc_statuses.id', '=', 'rapex_documents.status')
            ->where('rapex_documents.id', $id)
            ->get();
        return view('FileManager.su.RejectRapex', compact('file'));
    }
    public function RejectSave(Request $request, $id)
    {
        $file = ServiceUgandaCenter::findOrFail($id);
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
            return redirect()->route('scheme.service.list')->with('success', 'Rejection Reason Successfully added');
        } else {
            return redirect()->route('scheme.file.reject', $id)->with('error', 'Something Went Wrong');
        }
    }
    public function SoftDelete(Request $request, $id)
    {
        $file             = ServiceUgandaCenter::findOrFail($id);
        $file->status     = 5;
        $file->DeletedBy  = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;
        $file->RestoredBy = null;
        $file->save();
        $file->delete();
        return redirect()->route('su.file.list')->with('success', 'File moved to Bin successfully');
    }
    public function Restore($id)
    {
        $vote = ServiceUgandaCenter::withTrashed()->findOrFail($id);
        $vote->restore();
        $vote->status     = 2;
        $vote->DeletedBy  = null;
        $vote->RestoredBy = Auth::user()->sname . " " . Auth::user()->fname . " " . Auth::user()->oname;
        $vote->save();
        return redirect()->route('su.file.list')->with('success', 'File Restored successfully');
    }
    public function Delete(Request $request, $id)
    {
        $Rapex         = ServiceUgandaCenter::findOrFail($id);
        $attachedfiles = $Rapex->file;
        $filesToDelete = [];
        $attachments   = explode(',', $attachedfiles);
        foreach ($attachments as $attache) {
            $pdfx  = explode('_', $attache);
            $month = $pdfx[1];
            $year  = $pdfx[2];
            $path  = "storage/Rapex/" . $year . "/" . $month . "/" . $attache;
            //  $filed  = File::get($path);
            $docArray[] = $path;

        }
        $filesToDelete = implode(',', $docArray);
        $finalzip      = explode(',', $filesToDelete);
        foreach ($finalzip as $file) {
            $realfile = File::make($file);
            $realfile->delete();
        }
        $Rapex->forceDelete();
        return redirect()->route('su.file.list')->with('success', 'All Files Deleted Successfully');
    }
    public function ShowDetails(Request $request, $id)
    {

        $file = SUImages::select('rapex_images.id', 'rapex_images.imagefiles', 'rapex_images.rapex_id', 'rapex_documents.entity', 'rapex_documents.institution', 'rapex_documents.file', 'rapex_documents.comment', 'rapex_documents.zoomlink', 'users.fname', 'users.sname', 'users.oname')
            ->join('rapex_documents', 'rapex_documents.id', '=', 'rapex_images.rapex_id')
            ->join('users', 'users.id', '=', 'rapex_documents.UploadedBy')
            ->where('rapex_images.rapex_id', $id)
            ->get();

        return view('FileManager.su.RapexDetailed', compact('file'));

    }
    public function Edit(Request $request, $id)
    {
        $Rapex = ServiceUgandaCenter::findOrFail($id);

    }

    public function Update(Request $request, $id)
    {
        $Rapex = ServiceUgandaCenter::findOrFail($id);

    }

}
