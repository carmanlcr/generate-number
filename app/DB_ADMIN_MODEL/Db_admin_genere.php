<?php

namespace App\DB_ADMIN_MODEL;

use Illuminate\Database\Eloquent\Model;

class Db_admin_genere extends Model
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
    protected $table = 'db_admin_generes';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'generes_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'name',
         'generes_id_fb',
         'active_fb',
         'generes_id_ig',
         'active_ig',
         'generes_id_tw',
         'active',
         'campaings_id',
    ];
}
