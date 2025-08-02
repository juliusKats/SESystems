<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
class ServiceUgandaCenter extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;
    //
    protected $fillable =  ['Draft','status','centerId','SUCenter','file','comment','zoomlink', 'updated_at','UploadedOn','UploadedBy','Approve','ApprovedOn','ApprovedBy','approved_by','DeletedBy','RestoredBy'];
    protected $dates = ['deleted_at'];
}
