<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;


class ContactUS extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;
    //
    protected $fillable = ['fullname','telephone','email','subject','message','screenshot','read','status'];
protected $dates    = ['deleted_at'];
}
