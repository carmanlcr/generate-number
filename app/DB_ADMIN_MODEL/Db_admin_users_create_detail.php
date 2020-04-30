<?php

namespace App\DB_ADMIN_MODEL;

use Illuminate\Database\Eloquent\Model;

class Db_admin_users_create_detail extends Model
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
    protected $table = 'db_admin_users_create_details';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'users_create_details_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'fPerfil',
         'fPortada',
         'fAdicional',
         'active',
         'users_create_id',
    ];

    public function users_create(){
        return $this->belongsTo('App\DB_ADMIN_MODEL\Db_admin_users_create','users_create_id','users_create_id');
    }
}
