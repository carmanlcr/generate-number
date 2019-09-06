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

class Phone extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'PHONES';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'PHONES_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'AREACODES_ID', 'PHONE', 'DATE', 'USERS_ID',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     * @author Luis Morales
     */
    public $timestamps = false;

    /**
     * Get the user for the phone
     * 
     * @author Luis Morales
     */
    public function users(){
        return $this->belongsTo('App\User');
    }

    /**
     * Get the area code for the phone
     * 
     * @author Luis Morales
     */
    public function areacodes(){
        return $this->belongsTo('App\AreaCode');
    }


    public function setPhoneAttribute($value){
        $this->attributes['PHONE'] = date("Y-m-d H:i:s");
    }

}
