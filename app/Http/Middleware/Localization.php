<?php

namespace Fickrr\Http\Middleware;

use Closure;

class Localization
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
	   if(\Session::has('lang'))
	   {
		   \App::setlocale(\Session::get('lang'));
	   }
	   return $next($request);
	}
}
