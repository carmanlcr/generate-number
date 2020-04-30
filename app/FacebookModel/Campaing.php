<?php

namespace App\FacebookModel;

use Illuminate\Database\Eloquent\Model;

class Campaing extends Model
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
    protected $table = 'categories';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'categories_id';

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

    public function user(){
        return $this->belongsToMany('App\FacebookModel\User','users_categories','categories_id','users_id')->withTimestamps();
    }
}
