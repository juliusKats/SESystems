<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;


class DocStatus extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;

    protected $fillable=['statusName'];
 protected $dates    = ['deleted_at'];

}
