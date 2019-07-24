<?php

namespace App\Services;

use PDF;
use Mail;
use App\Models\OrderInvoice;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Mail\DeliverySlipEmail;

class DeliverySlipPDFService
{
    private $OrderInvoice;
    private $OrderDetail;
    private $Category;

    function __construct()
    {
        $this->OrderInvoice = new OrderInvoice();
        $this->OrderDetail  = new OrderDetail();
        $this->Category     = new Category();
    }

    /**
     * Generate pdf file of delivery slip and send via email
     */
    function sendDeliverySlips() 
    {
        $filePath = storage_path('temp/deliveryslips.pdf');

        $orders = $this->OrderInvoice->getInProgressOrders();

        foreach ($orders as $order) {
            $orderDetails = $this->OrderDetail->getOrderDetails($order->id_order);
            foreach ($orderDetails as $orderDetail) {
                $orderDetail->product_category = $this->Category->getProductCategory($orderDetail->id_product);
                $orderDetail->image_path       = $this->getImageLink($orderDetail->link_rewrite, $orderDetail->id_image, 'home_default');
            }
            $order->order_details = $orderDetails;
        }

        $data = [
            'logo'   => 'decathlon-logo-main.jpg',
            'orders' => $orders
        ];

        $pdf = PDF::loadView('delivery-slip', $data);

		$pdf->output();
		$dompdf = $pdf->getDomPDF();

		$font = $dompdf->getFontMetrics()->getFont("Arial", "bold");
		$canvas = $dompdf->get_canvas();
		$canvas->page_text(260, 10, "Basket #{PAGE_NUM}", $font, 20, array(255, 0, 0));

		$pdf->save($filePath);
 		
 		$email = new DeliverySlipEmail('kevin.padilla0717@gmail.com', 'Order Delivery Slips for Picking', $filePath);
 		Mail::to('kevin.padilla0717@gmail.com')->send($email);
    }

    /**
     * Get image link
     * 
     * @param  $name
     * @param  $ids
     * @param  $type
     * @return string
     */
    private function getImageLink($name, $ids, $type = null)
    {
        $splitIds = explode('-', $ids);
        $idImage = (isset($splitIds[1]) ? $splitIds[1] : $splitIds[0]);
        $hash = hash_hmac('md5', 'p'.$idImage,'pixl@cdn2securityKey');
        $size = ['width' => 98, 'height' => 98];
        return 'https://contents.mediadecathlon.com/p'.$idImage.'/k$'.$hash.'/'.$name.'.jpg?&f='.$size['width'].'x'.$size['height'];
    }
}