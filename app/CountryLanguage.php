<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;


/**
*
*
* @author Luis Morales
* @version 1.0.0
*
*/
class CountryLanguage extends Pivot
{
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'COUNTRYS_LANGUAGE';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'COUNTRYS_LANGUAGE_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'OUNTRYS_ID', 'LANGUAGES_ID', 
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     * @author Luis Morales
     */
    public $timestamps = false;
}
