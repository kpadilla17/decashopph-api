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
		return response()->json(['message' => 'success']);
	}
}
