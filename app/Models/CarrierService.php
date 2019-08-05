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

class CarrierService extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table = 'de_carrier_service';
    protected $table = 'de_shipping_service';
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    // protected $primaryKey = 'id_carrier_service';
    protected $primaryKey = 'id_shipping_service';

    public function shippingCarrier()
    {
        return $this->belongsTo(ShippingCarrier::class, 'shipping_method_code', 'shipping_method_code');
    }
}