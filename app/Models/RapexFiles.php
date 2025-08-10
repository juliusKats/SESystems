<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;


class RapexFiles extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;
    //
    protected $fillable=['uploadedby', 'rapex_id', 'files'];
    protected $dates = ['deleted_at'];
}
