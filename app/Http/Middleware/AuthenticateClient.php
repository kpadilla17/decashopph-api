<?php
/**
 * Middleware Authenticate Parcel Perform Client
 *
 * To verify that the request came from Parcel Perform, 
 * compute the HMAC digest according to the following algorithm and compare it to the value in the HTTP-X-Hmac-SHA256 header. 
 * 
 * If they match, they can be sure that the Webhook was sent from Parcel Perform and the data has not been compromised.
 */

namespace App\Http\Middleware;

use Closure;

class AuthenticateClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $header    = $request->header('HTTP-X-Hmac-SHA256');
        $body      = $request->getContent();
        $secretKey = '953ee24c-09e3-4856-bb44-160c0274a98a';

        $encrypted = hash_hmac('sha256', $body, $secretKey);

        if ($encrypted !== $header) {
            return response()->json(['error' => 'Unauthorized Client'], 401);
        }
        return $next($request);
    }
}
