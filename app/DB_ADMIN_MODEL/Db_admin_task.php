<?php

namespace App\DB_ADMIN_MODEL;

use Illuminate\Database\Eloquent\Model;

class Db_admin_task extends Model
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
    protected $table = 'db_admin_tasks';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'tasks_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'campaings_id',
         'generes_id',
         'rrss_id',
         'date_publication',
         'phrase',
         'image',
         'isFanPage',
         'isGroups',
         'quantity_min',
         'quantity_groups',
         'active',
    ];

    public function campaings()
    {
        return $this->hasMany('App\DB_ADMIN_MODEL\Db_admin_campaing','campaings_id','campaings_id');
    }

    public function generes()
    {
        return $this->hasMany('App\DB_ADMIN_MODEL\Db_admin_genere','generes_id','generes_id');
    }

    public function rrss()
    {
        return $this->hasMany('App\DB_ADMIN_MODEL\Db_admin_rrss','rrss_id','rrss_id');
    }

    public function tasks_detail()
    {
        return $this->belongsTo('App\DB_ADMIN_MODEL\Db_admin_task_detail', 'tasks_id', 'tasks_id');
    }
}
