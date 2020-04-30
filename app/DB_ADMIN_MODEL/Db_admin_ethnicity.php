<?php

namespace App\DB_ADMIN_MODEL;

use Illuminate\Database\Eloquent\Model;

class Db_admin_ethnicity extends Model
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
    protected $table = 'db_admin_ethnicitys';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'ethnicitys_id';

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
}
