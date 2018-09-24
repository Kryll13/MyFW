<?php

namespace MyFW\App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('MyFW\App\Users');
    }
}