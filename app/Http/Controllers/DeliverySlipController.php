<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeliverySlipPDFService;
use PDF;

class DeliverySlipController extends Controller
{
    /**
     * Class constructor
     * 
     * @param DeliverySlipPDFService $DeliverySlipPDFService
     */
    public function __construct(DeliverySlipPDFService $DeliverySlipPDFService)
    {
        $this->DeliverySlipPDFService = $DeliverySlipPDFService;
    }

    /**
     * Endpoint to manually trigger the sending of delivery slip
     *
     * @return 
     */
    public function testGenerateDeliverySlip()
    {
        $response = $this->DeliverySlipPDFService->sendDeliverySlips();

        if (!$response) {
            return response()->json(['message' => 'no slips sent']);
        }

        return response()->json(['message' => 'success']);
    }
}
