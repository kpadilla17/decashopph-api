<?php
/**
 * Class Order 
 *
 * @package App\Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ParcelEvent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'de_parcel_event';

    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_parcel_event';


    public function getParcelEventStatus($statusKey, $idStore, $isShippingCarrier)
    {   
        $parcelEventStatus = DB::table($this->table . ' as ' . 'pe')
            ->join('de_parcel_event_status as pes', 'pes.id_parcel_event', '=', 'pe.id_parcel_event')
            ->join('de_order_state_store as oss', 'oss.id_order_state_store', '=', 'pes.id_order_state_store')
            ->join('de_order_state as os', 'os.id_order_state', '=', 'oss.id_order_state')
            ->where('pe.status_key', '=', $statusKey)
            ->whereIn('oss.id_store', [$idStore, 0])
            ->whereIn('oss.id_shipping_carrier', [$isShippingCarrier, 0])
            ->first();

        return $parcelEventStatus;   
    }
}