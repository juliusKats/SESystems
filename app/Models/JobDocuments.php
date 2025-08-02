<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobDocuments extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;
    protected $fillable=['Draft','carderId','versionId','CarderName','WordFile','ext','PDFFile','PSApprovalDate','comment','UploadedBy','updated_at','UploadedOn','Approve','ApprovedOn','ApprovedBy','UpdatedBy','approved_by','rejected','RejectedOn','RejectedBy','Reason','DeletedBy','status','RestoredBy','carder_id'];
     protected $dates = ['deleted_at'];

    }
