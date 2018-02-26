<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class achievement_best extends Model
{
    public function User()
    {
      return $this->belongsTo('App\User');
    }
}
