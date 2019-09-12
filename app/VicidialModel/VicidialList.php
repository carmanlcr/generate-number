<?php

namespace App\VicidialModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VicidialList extends Model
{
    
    const CREATED_AT = 'entry_date';
    const UPDATED_AT = 'modify_date';

    /**
     * The connection name for the model.
     *
     * @var string
     * @author Luis Morales
     */
    protected $connection = 'asterisk';

    /**
     * The table associated with the model.
     * 
     * @var string
     * @author Luis Morales
     */
    protected $table = 'vicidial_list';

    /**
     * The primary key associated with the table.
     *
     * @var string
     * @author Luis Morales
     */
    protected $primaryKey = 'lead_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @author Luis Morales
     */
    protected $fillable = [
        'entry_date',
        'modify_date',
        'status',
        'user',
        'vendor_lead_code',
        'source_id',
        'list_id',
        'gmt_offset_now',
        'called_since_last_reset',
        'phone_code',
        'phone_number',
        'title',
        'first_name',
        'middle_initial',
        'last_name',
        'address1',
        'address2',
        'address3',
        'city',
        'state',
        'province',
        'postal_code',
        'country_code',
        'gender',
        'date_of_birth',
        'alt_phone',
        'email',
        'security_phrase',
        'comments',
        'called_count',
        'last_local_call_time',
        'rank',
        'owner',
        'entry_list_id' 
    ];



    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     * @author Luis Morales
     */
    public $timestamps = false;

     /**
     * @see https://stackoverflow.com/a/25472319/470749
     * 
     * @param array $arrayOfArrays
     * @return bool
     */
    public static function insertIgnore($arrayOfArrays) {
        $STATUS_VALUE = 'NEW';
        $phone = new VicidialList();
        $static = new static();
        $table = with(new static)->getTable(); //https://github.com/laravel/framework/issues/1436#issuecomment-28985630
        $questionMarks = '';
        $values = [];
        $valorAutoIncrementable = 0;
        foreach ($arrayOfArrays as $k => $array) {
                //Setear el status del campo
                $array['status'] = $STATUS_VALUE;

                //Setear el list_id dependiendo de la zona
                switch ($array['zona']) {
                    case 1:
                        $array['list_id'] = 1000;
                        break;
                    case 2:
                        $array['list_id'] = 2000;
                        break;

                    case 3:
                        $array['list_id'] = 3000;
                        break;

                    case 4:
                        $array['list_id'] = 4000;
                        break;
                }
                unset($array['zona']);

                if ($valorAutoIncrementable > 0) {
                    $questionMarks .= ',';
                }
                $questionMarks .= '(?' . str_repeat(',?', count($array) - 1) . ')';
                $values = array_merge($values, array_values($array));//TOD
                $valorAutoIncrementable++;
                //Si hay 5000 registros hacer un insert
                if($k % 5000 == 0 AND $k > 0){ 

                    $query = 'INSERT IGNORE INTO ' .  $table . ' (' . implode(',', array_keys($array)) . ') VALUES ' . $questionMarks ;
                    
                    if(!DB::connection('asterisk')->insert($query, $values)) return false; 
                    $questionMarks = '';
                    $values = [];
                    $valorAutoIncrementable = 0;
                }
                \Debugbar::info($array);
        }   

        $query = 'INSERT IGNORE INTO ' . $table . ' (' . implode(',', array_keys($array)) . ') VALUES ' . $questionMarks.';';

        DB::connection('asterisk')->insert($query, $values);
    }
}
