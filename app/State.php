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

class State extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'STATES';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'STATES_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'NAME', 'COUNTRYS_ID',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     * @author Luis Morales
     */
    public $timestamps = false;

    /**
     * 
	 * Get the country of the state
     * 
     * @author Luis Morales
     */
    public function countrys(){
        return $this->belongsTo('App\Country');
    }

    /**
     * Get the state zone that has state
     *
     * @author Luis Morales
     */
    public function zones()
    {
        return $this->belongsToMany('App\Zone', 'STATESZONE', 'STATES_ID', 'ZONES_ID')->using('App\StateZone');
    }

    /**
     * Get the analyzed phone associated with the state
     *
     * @author Luis Morales
     */
    public function analyzedPhones(){
        return $this->hasOne('App\AnalyzedPhone');
    }
}
