<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'calls';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'CALLS_ID';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'DATE',
         'ONE',
         'TWO',
         'THREE',
         'THREE_TO_FIVE',
         'MORE_THAN_FIVE',
         'CREATED_AT',
         'UPDATED_AT',
    ];

}
