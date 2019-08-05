<?php
/**
 * Class Order 
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'de_orders';

    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_order';

    public $timestamps = false;

    /**
     * Get the phone record associated with the user.
     */
    public function orderCarrier()
    {
        return $this->hasOne('App\Models\OrderCarrier', 'id_order');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }

    public function store()
    {
        return $this->hasOne('App\Models\OrderMultiStorePicking', 'id_order');
    }
}