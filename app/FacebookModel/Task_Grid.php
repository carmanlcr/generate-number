<?php

namespace App\FacebookModel;

use Illuminate\Database\Eloquent\Model;

class Task_Grid extends Model
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
    protected $table = 'tasks_grid';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'tasks_grid_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'categories_id',
         'generes_id',
         'date_publication',
         'phrase',
         'image',
         'isFanPage',
         'isGroups',
         'quantity_min',
         'active',
         'db_admin_tasks_id',
    ];

   public function categories()
    {
        return $this->hasMany('App\FacebookModel\Campaing','categories_id','categories_id');
    }

    public function generes()
    {
        return $this->hasMany('App\FacebookModel\Genere','generes_id','generes_id');
    }
}
