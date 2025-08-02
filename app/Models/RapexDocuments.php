<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;


class RapexDocuments extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;
    protected $fillable =  ['Draft','entity','institution','file','comment','zoomlink', 'updated_at','UploadedOn','UploadedBy','Approve','ApprovedOn','ApprovedBy','approved_by','DeletedBy','RestoredBy','status'];
    protected $dates = ['deleted_at'];
}
