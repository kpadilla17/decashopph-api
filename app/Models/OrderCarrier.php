<?php
/**
 * Class OrderCarrier 
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCarrier extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'de_order_carrier';
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_order_carrier';

    /**
     * Get the user that owns the phone.
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'id_order', 'id_order');
    }
}