<?php

namespace App\FacebookModel;

use Illuminate\Database\Eloquent\Model;

class Task_Grid_Detail extends Model
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
    protected $table = 'tasks_grid_detail';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'tasks_grid_detail_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'users_id',
         'tasks_grid_id',
    ];

   public function categories()
    {
        return $this->hasMany('App\FacebookModel\Tasks_Grid','tasks_grid_id','tasks_grid_id');
    }

}
