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
    protected $table = 'CALLS';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'CALLS_ID';

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
    ];

}
