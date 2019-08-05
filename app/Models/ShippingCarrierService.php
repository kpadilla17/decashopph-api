<?php
/**
 * Class Category 
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShippingCarrier;
use DB;

class ShippingCarrierService extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'de_shipping_carrier_service';
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_shipping_carrier_service';

    public function shippingCarrier()
    {
        return $this->belongsTo(ShippingCarrier::class, 'shipping_carrier_code', 'shipping_carrier_code');
    }
}