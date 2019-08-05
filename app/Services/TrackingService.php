<?php
/**
 * Class TrackingService 
 *
 * @package App\Services
 */
namespace App\Services;

use Mail;
use App\Models\Order;
use App\Models\OrderCarrier;
use App\Models\ParcelEvent;
use App\Mail\TrackingEmail;
use App\Models\OrderHistory;

class TrackingService
{
    private const DEFAULT_ID_STORE     = 2;
    private const DELIVERED_STATUS_KEY = 'H10';

    public function saveParcelTracking($trackingData)
    {
        date_default_timezone_set('Asia/Manila');
        
        if (!$this->validateTrackingData($trackingData)) {
            return false;
        }

        $trackingNumber = $trackingData['data']['parcel_id'];
        $trackingEvent  = $trackingData['data']['last_event'];

        $orderCarrier = OrderCarrier::where('tracking_number', '=', $trackingNumber)->first();

        if (empty($orderCarrier)) {
            // Error log, parcel tracking does not exists 
            return false;
        }

        $order = $orderCarrier->order;

        $templateData = [
            'customer'        => $order->customer->firstname,
            'tracking_number' => $orderCarrier->tracking_number
        ];

        $idStore          = (empty($order->store) ? self::DEFAULT_ID_STORE : $order->store->id_multistore_store);
        $idShippingCarrier = $orderCarrier->carrierService->shippingCarrier->id_shipping_carrier;
        $statusKey        = $trackingEvent['event_key'];
        
        $ParcelEvent = new ParcelEvent();
        $eventStatus = $ParcelEvent->getParcelEventStatus($statusKey, $idStore, $idShippingCarrier);

        if (!$eventStatus) {
            // Log event status not found
        }

        // If the corresponding status of the event is the same as the current status,
        if ($order->current_state == $eventStatus->id_order_state) {
            // Log the event and exit the function
            return false;
        }

        $order->current_state = $eventStatus->id_order_state;
        $order->valid         = $eventStatus->logable;
        $order->save();

        $history = new OrderHistory();
        $history->id_order       = $order->id_order;
        $history->id_employee    = 0;
        $history->id_order_state = $eventStatus->id_order_state;
        $history->date_add       = date('Y-m-d H:i:s');
        $history->save();        

        $subject = 'Your order is being shipped';
        if ($eventStatus->status_key == self::DELIVERED_STATUS_KEY) {
            $subject = 'Your order has been delivered';
        }

        $template = $eventStatus->email_template;

        $TrackingEmail = new TrackingEmail(
            'contact.philippines@decathlon.com', 
            $subject,
            $template,
            $templateData
        );

        return Mail::to($order->customer->email)->send($TrackingEmail);
    }


    public function validateTrackingData($trackingData)
    {
        $errors = [];

        if (!isset($trackingData['data'])) {
            $errors[] = 'Webhook data is missing.';
        }

        if (
            !isset($trackingData['data']['parcel_id']) ||
            empty($trackingData['data']['parcel_id'])
        ) {
            $errors[] = 'Webhook parcel_id is missing.';
        }

        if (!isset($trackingData['data']['last_event'])) {
            $errors[] = 'Webhook last_event is missing.';
        }

        if (
            !isset($trackingData['data']['last_event']['event_key']) ||
            empty($trackingData['data']['last_event']['event_key'])
        ) {
            $errors[] = 'Webhook event_key is missing.';
        }

        if (!empty($errors)) {
            // Log errors
            return false;
        }

        return true;
    }
}