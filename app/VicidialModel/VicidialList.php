<?php

namespace App\VicidialModel;

use Illuminate\Database\Eloquent\Model;

class VicidialList extends Model
{

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

}
