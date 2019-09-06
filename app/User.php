<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
*
*
* @author Luis Morales
* @version 1.0.0
*
*/

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'USERS';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'USERS_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'NAME', 'USERNAME', 'EMAIL', 'PASSWORD', 'USERROLES_ID',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     * @author Luis Morales
     */
    protected $hidden = [
        'PASSWORD', 'REMEMBER_TOKEN',
    ];

    /**
     * Get the user role for the user
     * 
     * @author Luis Morales
     */
    public function userroles(){
        return $this->belongsTo('App\UserRole');
    }

    /**
     * Get the phone for the user
     *
     * @author Luis Morales
     */
    public function phones(){
        return $this->hasMany('App\Phone');
    }

}
