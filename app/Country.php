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

class Country extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'COUNTRYS';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'COUNTRYS_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'COUNTRYS_CODE','NAME', 
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     * @author Luis Morales
     */
    public $timestamps = false;

    /**
     * Get the states of the country
     *
     * @author Luis Morales
     */
    public function state(){
        return $this->hasMany('App\State');
    }

    /**
     * The languages ​​that belong to the country
     *
     * @author Luis Morales
     */
    public function languages()
    {
        return $this->belongsToMany('App\Language', 'COUNTRYS_LANGUAGE', 'COUNTRYS_ID', 'LANGUAGE_ID');
    }

}
