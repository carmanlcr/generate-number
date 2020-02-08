<?php

namespace App\DB_ADMIN_MODEL;

use Illuminate\Database\Eloquent\Model;

class Db_admin_users_create extends Model
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
    protected $table = 'db_admin_users_create';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'users_create_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'full_name',
         'phones_id',
         'gender',
         'date_of_birth',
         'password',
         'vpn',
         'active',
         'create_fb',
         'create_ig',
         'create_tw',
    ];

    public function users_create_detail(){
        return $this->hasOne('App\DB_ADMIN_MODEL\Db_admin_users_create_detail','users_create_id','users_create_id');
    }
}
