<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class personality extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User', 'user_id');
    }
}
