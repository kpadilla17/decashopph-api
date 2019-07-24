<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeliverySlipPDFService;
use PDF;

class DeliverySlipController extends Controller
{

	public function __construct(DeliverySlipPDFService $DeliverySlipPDFService)
	{
		$this->DeliverySlipPDFService = $DeliverySlipPDFService;
	}

	public function testGenerateDeliverySlip()
	{
		return $this->DeliverySlipPDFService->sendDeliverySlips();
	}
}
