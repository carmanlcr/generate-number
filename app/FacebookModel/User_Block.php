<?php

namespace App\FacebookModel;

use Illuminate\Database\Eloquent\Model;

class User_Block extends Model
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
    protected $table = 'users_block';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'users_block_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'users_id',
         'comentario',
         'active',
    ];

    public function users()
    {
        return $this->hasMany('App\FacebookModel\User','users_id','users_id');
    }
}
