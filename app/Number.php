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
class Number extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'NUMBERS';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'NUMBERS_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'NUMBER', 'DATE', 'PROCESSED',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     * @author Luis Morales
     */
    public $timestamps = false;
}
