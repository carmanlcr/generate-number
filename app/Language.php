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
class Language extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'LANGUAGES';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'LANGUAGES_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'LANGUAGE', 
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     * @author Luis Morales
     */
    public $timestamps = false;

    /**
     * Get the dictionary letters for the language
     *
     * @author Luis Morales
     */
    public function dictionary(){
        return $this->hasMany('App\Dictionary');
    }

     /**
     * The country to which the language belongs
     *
     * @author Luis Morales
     */
    public function country()
    {
        return $this->belongsToMany('App\Country');
    }

    /**
     * Get the analyzed phone that has the language
     *
     * @author Luis Morales
     */
    public function analyzedphones()
    {
        return $this->belongsTo('App\AnalyzedPhone');
    }

}
