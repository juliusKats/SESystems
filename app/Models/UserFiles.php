<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserFiles extends Model  implements AuditableContract
{
    use SoftDeletes;
    use Auditable;

    //
    protected $fillable=['VoteCode','VoteName','comment','Approve','excelOriginal','excelfile','pdffile','pdfsize','psApprovedOn','ApprovedOn','UploadedBy','ApprovedBy','UploadedOn','updated_at','approved_by','versionname','DeletedBy','RestoredBy'] ;

     protected $dates = ['deleted_at'];
}

