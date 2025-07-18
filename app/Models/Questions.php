<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
class Questions extends Model  implements AuditableContract
{
    use Auditable;
    //
    protected $fillable=['mobile','question','details','reply','is_replied','repliedOn','active','repliedBy'];

}
