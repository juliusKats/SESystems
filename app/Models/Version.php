<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $fillable=['versionname', 'versionabbrev', 'status'];
}
