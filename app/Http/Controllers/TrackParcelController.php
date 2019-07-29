<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TrackingService;

class TrackParcelController extends Controller
{
    private $TrackingService;

    public function __construct(TrackingService $TrackingService)
    {
        $this->TrackingService = $TrackingService;
    }

    public function index()
    {
        return response()->json(['message' => 'success']);
    }

    public function store(Request $Request)
    {
        $content  = $Request->getContent();
        $body     = json_decode($content, true);
        $this->TrackingService->saveParcelTracking($body);
        return response()->json(['message' => 'success']);
    }
}
