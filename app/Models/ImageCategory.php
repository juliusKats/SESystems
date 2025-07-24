<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ImageCategory extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;
     protected $fillable=['Category','status'];
     protected $dates    = ['deleted_at'];



}
