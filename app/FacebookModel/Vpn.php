<?php

namespace App\FacebookModel;

use Illuminate\Database\Eloquent\Model;

class Vpn extends Model
{
     /**
     * The connection name for the model.
     *
     * @var string
     * @author Luis Morales
     */
    protected $connection = 'facebook';

    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'vpn';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'vpn_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'name',
         'active',
    ];

    public function users()
    {
        return $this->hasMany('App\FacebookModel\User','users_id','users_id');
    }
}
