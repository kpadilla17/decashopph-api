<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackParcelController extends Controller
{

	public function index()
	{
		return response()->json(['message' => 'success']);
	}

	public function store(Request $Request)
	{
		$content  = $Request->getContent();
		$body     = json_decode($content, true);
		$filename = sprintf('parcel_tracking_%s_%s.json', $body['data']['parcel_id'], date('YmdHis'));
		$filePath = storage_path($filename);
		$file     = fopen($filePath, 'w');

		fwrite($file, json_encode($body));
		fclose($file);

		return response()->json(['message' => 'success']);
	}
}
