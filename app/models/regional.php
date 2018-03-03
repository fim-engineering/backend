<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class regional extends Model
{
    public function users()
    {
      return $this->hasMany('App\User', 'regional_id');
    }
}
