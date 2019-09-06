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
class AreaCode extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'AREACODES';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'AREACODES_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'CODE', 'CITY', 'STATESZONE_ID',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     * @author Luis Morales
     */
    public $timestamps = false;

    /**
     * Get the phone for the area codes
     *
     * @author Luis Morales
     */
    public function phones(){
        return $this->hasMany('App\Phone');
    }

    /**
     * 
	 * Get the state zone for the area code
     * 
     * @author Luis Morales
     */
    public function stateszone(){
        return $this->belongsTo('App\StateZone');
    }
}
