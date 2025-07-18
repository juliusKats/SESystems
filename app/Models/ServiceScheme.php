<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ServiceScheme extends Model implements AuditableContract
{
     use SoftDeletes;
    use Auditable;
    protected $fillable=['CarderName','WordFile','ext','PDFFile','PSApprovalDate','comment','UploadedBy','updated_at','UploadedOn','Approve','ApprovedOn','ApprovedBy','UpdatedBy','approved_by','rejected','RejectedOn','RejectedBy','Reason','DeletedBy','RestoredBy','carder_id'];
     protected $dates = ['deleted_at'];

}
