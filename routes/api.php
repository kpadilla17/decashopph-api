<?php

use App\Http\Middleware\AuthenticateClient;

Route::post('track-parcel', 'TrackParcelController@store')
	->middleware(AuthenticateClient::class);

Route::get('track-parcel', 'TrackParcelController@index');

Route::fallback(function(){
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');