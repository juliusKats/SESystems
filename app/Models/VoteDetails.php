<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;


class VoteDetails extends Model implements AuditableContract
{
    use Auditable;

    //
    protected $fillable = ['votecode','votename','Active','updated_at'];
}
