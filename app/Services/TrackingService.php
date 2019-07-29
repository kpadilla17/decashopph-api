<?php
/**
 * Class TrackingService 
 *
 * @package App\Services
 */
namespace App\Services;

use App\Models\Order;
use App\Models\OrderCarrier;

class TrackingService
{
    public function saveParcelTracking($trackingData)
    {
        $trackingNumber = isset($trackingData['data']['parcel_id']) ? $trackingData['data']['parcel_id'] : null;

        if (empty($trackingNumber)) {
            // Erro log, invalid or missing parcel id
        }

        $orderCarrier = OrderCarrier::where('tracking_number', '=', $trackingNumber)->first();

        if ($orderCarrier) {
            // Error log, parcel tracking does not exists 
        }

        $order = $orderCarrier->order;

        print_r($order); 

        echo 1; 
        exit;


        // print_r($trackingNumber); exit;

    }
}