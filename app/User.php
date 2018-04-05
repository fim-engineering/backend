<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;




class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'username','name', 'email', 'password',
    // ];
    protected $guarded =['id'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','keyword'
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return ['user' => [
                'id' => $this->id,

             ]];
    }

    /**
     * relationship
     */

     public function profiles()
     {
       return $this->hasOne('App\models\profile', 'user_id');
     }

     public function achievements()
     {
       return $this->hasMany('App\models\achievement');
     }

     public function personality()
     {
       return $this->hasOne('App\models\personality', 'user_id');
     }

     public function achievement_bests()
     {
       return $this->hasOne('App\models\achievement_best', 'user_id');
     }

     public function me_and_fim()
     {
       return $this->hasOne('App\models\me_and_fim', 'user_id');
     }


}
