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
class StateZone extends Model
{

	/**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'STATESZONE';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'STATESZONE_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'ZONES_ID', 'STATES_ID',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     * @author Luis Morales
     */
    public $timestamps = false;

    /**
     * Get the status zone for area codes
     *
     * @author Luis Morales
     */
    public function areacodes(){
        return $this->hasMany('App\AreaCode');
    }
    
}
