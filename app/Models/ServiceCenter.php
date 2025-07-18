<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCenter extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;
    //
     protected $fillable =  ['centerName','status'];
     protected $dates = ['deleted_at'];
}
