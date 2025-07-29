<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;


class EDBRTeam extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;

    protected $fillable=['None','Pending','Approved','Rejected','Deleted','Restored'];
    protected $dates    = ['deleted_at'];
}
