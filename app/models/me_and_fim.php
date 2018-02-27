<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class me_and_fim extends Model
{
    public function User()
    {
      return $this->belongsTo('App\User','user_id');
    }
}
