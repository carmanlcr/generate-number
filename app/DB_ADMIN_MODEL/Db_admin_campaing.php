<?php

namespace App\DB_ADMIN_MODEL;

use Illuminate\Database\Eloquent\Model;

class Db_admin_campaing extends Model
{

    /**
     * The connection name for the model.
     *
     * @var string
     * @author Luis Morales
     */
    protected $connection = 'db_admin';

    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'db_admin_campaings';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'campaings_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'name',
         'active_fb',
         'active_ig',
         'active_tw',
    ];

    public function rrss(){
        return $this->belongsToMany('App\DB_ADMIN_MODEL\Db_admin_rrss','db_admin_campaings_rrss','campaings_id','rrss_id')->withTimestamps();
    }
}
