<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class YearMonths extends Model implements AuditableContract
{
    //
     use Auditable;
    protected $fillable=['mNames'];
}


