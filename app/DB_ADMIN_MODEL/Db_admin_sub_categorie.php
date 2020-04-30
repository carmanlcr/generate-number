<?php

namespace App\DB_ADMIN_MODEL;

use Illuminate\Database\Eloquent\Model;

class Db_admin_sub_categorie extends Model
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
    protected $table = 'db_admin_sub_categories';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'sub_categories_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'name',
    ];
}
