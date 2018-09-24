<?php

namespace MyFW\App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo('MyFW\App\Roles', 'roles_id');
    }
    /*
        public function roles(){
            return $this->belongsTo('MyFW\App\Roles');
        }
    */
}