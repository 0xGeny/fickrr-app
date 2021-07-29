<?php

namespace Fickrr\Http\Middleware;
use Illuminate\Http\Response;
use Closure;
use Illuminate\Support\Facades\Cookie;

class CheckReferral
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
        
		$response = $next($request);

		
		if (! $request->hasCookie('referral') && $request->query('ref') ) 
		{
		 
		  $response->cookie( 'referral', encrypt( $request->query('ref') ), 500 );
		  
		}
		
		return $response;
		
		
    }
}
