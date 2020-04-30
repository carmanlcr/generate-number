<?php

namespace App\FacebookModel;

use Illuminate\Database\Eloquent\Model;

class User extends Model
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
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'users_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'username',
         'email',
         'full_name',
         'phone',
         'password',
         'creator',
         'date_of_birth',
         'active',
         'sim_card_number',
         'vpn_id',
    ];

    public function campaing(){
        return $this->belongsToMany('App\FacebookModel\Campaing','users_categories','users_id','categories_id')->withTimestamps();
    }

    public function users_block()
    {
        return $this->hasMany('App\FacebookModel\User_Block','users_id');
    }

}
