<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
*
*
* @author Luis Morales
* @version 1.0.0
*
*/

class Phone extends Model
{

    
    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'PHONES';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'PHONES_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'AREACODES_ID', 'PHONE', 'DATE', 'USERS_ID',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     * @author Luis Morales
     */
    public $timestamps = false;

    /**
     * Get the user for the phone
     * 
     * @author Luis Morales
     */
    public function users(){
        return $this->belongsTo('App\User');
    }

    /**
     * Get the area code for the phone
     * 
     * @author Luis Morales
     */
    public function areacodes(){
        return $this->belongsTo('App\AreaCode', 'AREACODES_ID');
    }   


    /**
     * @see https://stackoverflow.com/a/25472319/470749
     * 
     * @param array $arrayOfArrays
     * @return bool
     */
    public static function insertIgnore($arrayOfArrays) {
        $phone = new Phone();
        $static = new static();
        $table = with(new static)->getTable(); //https://github.com/laravel/framework/issues/1436#issuecomment-28985630
        $questionMarks = '';
        $values = [];
        $valorAutoIncrementable = 0;
        $array1 = array();
        $date = date("Y-m-d H:i:s");
        
        foreach ($arrayOfArrays as $k => $array) {
                
                $array['DATE'] =  $date;
                if ($valorAutoIncrementable > 0) {
                    $questionMarks .= ',';
                }
                $questionMarks .= '(?' . str_repeat(',?', count($array) - 1) . ')';
                $values = array_merge($values, array_values($array));//TODO
                
                $valorAutoIncrementable++;
                //Si hay 1000 registros hacer un insert
                if($k % 5000 == 0 AND $k > 0){ 

                    $query = 'INSERT IGNORE INTO ' . $table . ' (' . implode(',', array_keys($array)) . ') VALUES ' . $questionMarks ;
                    
                    
                    if(!DB::insert($query, $values)) return false; 
                    $questionMarks = '';
                    $values = [];
                    $valorAutoIncrementable = 0;
                }
        }   

        $query = 'INSERT IGNORE INTO ' . $table . ' (' . implode(',', array_keys($array)) . ') VALUES ' . $questionMarks.';';
        
        if(DB::insert($query, $values)){
            return $date;
        }
    }

}
