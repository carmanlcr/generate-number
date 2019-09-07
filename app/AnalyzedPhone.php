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
class AnalyzedPhone extends Model
{

    
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'ANALYZEDPHONES';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'ANALYZEDPHONES_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'PHONES_ID', 'TEXT', 'DATE', 'SERVER', 'STATES_ID', 'LANGUAGE_ID',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     * @author Luis Morales
     */
    public $timestamps = false;


    /**
     * Obtain the telephone record associated with the analyzed telephone.
     *
     * @author Luis Morales
     */
    public function phone(){
        return $this->hasOne('App\Phone');
    }

    /**
     * Get the status for the analyzed phone.
     * 
     * @author Luis Morales
     */
    public function states(){
        return $this->belongsTo('App\State');
    }

    /**
     * Get the language associated with the analyzed phone.
     *
     * @author Luis Morales
     */
    public function language(){
        return $this->hasOne('App\Language');
    }
}
