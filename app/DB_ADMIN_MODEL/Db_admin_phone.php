<?php

namespace App\DB_ADMIN_MODEL;

use Illuminate\Database\Eloquent\Model;

class Db_admin_phone extends Model
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
    protected $table = 'db_admin_phones';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'phones_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
         'phone',
         'sim_card_number',
         'number_sim',
         'pin_simcard',
         'puk_simcard',
         'operators_id',
    ];

    public function operatorss()
    {
        return $this->hasMany('App\DB_ADMIN_MODEL\Db_admin_operator','operators_id','operators_id');
    }
}
