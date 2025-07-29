<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //

    public function permissions() {

   return $this->belongsToMany(Permissions::class,'roles_permissions');

}

public function users() {

   return $this->belongsToMany(User::class,'users_roles');

}
}
