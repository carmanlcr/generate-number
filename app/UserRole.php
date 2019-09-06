<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
*
*
* @author Luis Morales
* @version 1.0.0
*
*/

class UserRole extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'USERROLES';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'USERROLES_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'NAME',
    ];

    /**
     * Get the user for the user roles
     *
     * @author Luis Morales
     */
    public function users(){
        return $this->hasMany('App\User');
    }
}
