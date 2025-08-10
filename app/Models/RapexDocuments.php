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
    protected $fillable =  ['ticket','Draft','entity','institution','file','comment','zoomlink', 'updated_at','UploadedOn','UploadedBy','Approve','ApprovedOn','ApprovedBy','approved_by','DeletedBy','RestoredBy','status'];
    protected $dates = ['deleted_at'];




    // public function setEntityAttribute($value)

    // {
    //     $this->attributes['entity'] = json_encode($value);

    // }


    // public function getEntityAttribute($value)

    // {

    //     return $this->attributes['entity'] = json_decode($value);
    // }

    // public function setInstituteAttribute($value)

    // {

    //     $this->attributes['institution'] = json_encode($value);

    // }


    // public function getinstituteAttribute($value)

    // {

    //     return $this->attributes['institution'] = json_decode($value);
    // }
}
