<?php

namespace App\VicidialModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $date = Carbon::now();
        $dateTimePrevious = $date->format('Y-m-d H:m:s');
        $STATUS_VALUE = 'NEW';
       // $phone = new VicidialList();
       // $static = new static();
       // $table = with(new static)->getTable(); //https://github.com/laravel/framework/issues/1436#issuecomment-28985630
       // $questionMarks = '';
        //$values = [];
       // $valorAutoIncrementable = 0;
        $cantidadDeNumerosInsertados = 1;
        foreach ($arrayOfArrays as $k => $array) {
                //Setear el entry_date
                $array['entry_date'] = $dateTimePrevious;  
                //Setear phone_code
                $array['phone_code'] = 1;      
                //Setear el status del campo
                $array['status'] = $STATUS_VALUE;
                //Setear Vendor_lead_code
                $array['vendor_lead_code'] = "";
                //Setear source_id
                $array['source_id'] = "";
                //Setear gender
                $array['gender'] = "U";
                //Setear title
                $array['title'] = "";
                //Setear first_name
                $array['first_name'] = "";
                //Setear middle_initial
                $array['middle_initial'] = "";
                //Setear last_name
                $array['last_name'] = "";
                //Setear address1
                $array['address1'] = "";
                //Setear address2
                $array['address2'] = "";
                //Setear address3
                $array['address3'] = "";
                //Setear city
                $array['city'] = "";
                //Setear province
                $array['province'] = "";
                //Setear postal_code
                $array['postal_code'] = "";
                //Setear country_code
                $array['country_code'] = "";
                //Setear date_of_birth
                $array['date_of_birth'] = "2001-01-01";
                //Setear alt_phone
                $array['alt_phone'] = "";
                //Setear email
                $array['email'] = "";
                //Setear security_phrase
                $array['security_phrase'] = "";
                //Setear comments
                $array['comments'] = "";

                //Setear el list_id dependiendo de la zona
                switch ($array['zona']) {
                    case 1:
                        $array['list_id'] = 1000;
                        $array['gmt_offset_now'] = -4.00;
                        break;
                    case 2:
                        $array['list_id'] = 2000;
                        $array['gmt_offset_now'] = -7.00;
                        break;

                    case 3:
                        $array['list_id'] = 3000;
                        $array['gmt_offset_now'] = -6.00;
                        break;

                    case 4:
                        $array['list_id'] = 4000;
                        $array['gmt_offset_now'] = -7.00;
                        break;
                }
                unset($array['zona']);

               /* if ($valorAutoIncrementable > 0) {
                    $questionMarks .= ',';
                }
                $questionMarks .= '(?' . str_repeat(',?', count($array) - 1) . ')';
                $values = array_merge($values, array_values($array));//TOD
                $valorAutoIncrementable++;
                
                mb_convert_encoding($array, 'UTF-8', 'UTF-8');*/
                $cantidadDeNumerosInsertados++;
                /*if($k % 100 == 0 AND $k > 0){ 

                    $query = 'INSERT IGNORE INTO ' .  $table . ' (' . implode(',', array_keys($array)) . ') VALUES ' . $questionMarks ;
                    
                    if(!DB::connection('asterisk')->insert($query, $values)) return false; 
                    $questionMarks = '';
                    $values = [];
                    $valorAutoIncrementable = 0;
                }*/

                VicidialList::on('asterisk')->firstOrCreate(
                    ['phone_number' => $array['phone_number']],
                    ['state' => substr($array['state'],0,2),
                    'user' => $array['user'],
                    'entry_date' => $array['entry_date'],
                    'phone_code' => $array['phone_code'],
                    'status' => $array['status'],
                    'vendor_lead_code' => $array['vendor_lead_code'],
                    'source_id' => $array['source_id'],
                    'gender' => $array['gender'],
                    'title' => $array['title'],
                    'first_name' => $array['first_name'],
                    'middle_initial' => $array['middle_initial'],
                    'last_name' => $array['last_name'],
                    'address1' => $array['address1'],
                    'address2' => $array['address2'],
                    'address3' => $array['address3'],
                    'city' => $array['city'],
                    'province' => $array['province'],
                    'postal_code' => $array['postal_code'],
                    'country_code' => $array['country_code'],
                    'date_of_birth' => $array['date_of_birth'],
                    'alt_phone' => $array['alt_phone'],
                    'email' => $array['email'],
                    'security_phrase' => $array['security_phrase'],
                    'comments' => $array['comments'],
                    'list_id' => $array['list_id'],
                    'gmt_offset_now' => $array['gmt_offset_now']]
                );

        }   


        /*mb_convert_encoding($array, 'UTF-8', 'UTF-8');
        $query = 'INSERT IGNORE INTO ' . $table . ' (' . implode(',', array_keys($array)) . ') VALUES ' . $questionMarks.';';
        

        DB::connection('asterisk')->insert($query, $values);*/

        return $cantidadDeNumerosInsertados;
    }
}
