<?php

namespace Fickrr\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XSS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();
        array_walk_recursive($input, function(&$input) {
            $input = strip_tags($input, '<h1><h2><h3><h4><h5><h6><b><strong><p><span><ol><ul><li><div><a><br><pre><img><table><tr><td><th><em><i><u><small><strike><center><font><link><meta><hr><form><input><option>');
        });
        $request->merge($input);
        return $next($request);
    }
}
