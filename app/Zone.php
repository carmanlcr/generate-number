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
class Zone extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'ZONES';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'ZONES_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'NAME', 
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
    public function states()
    {
        return $this->belongsToMany('App\State');
    }
}
