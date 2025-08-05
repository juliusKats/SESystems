<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;


class Inquiries  extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;
    protected $fillable=['fullname','telephone','email','inquiry','reply','replied','repliedBy','repliedOn','status','subject'];
    protected $dates    = ['deleted_at'];
}
