<?php

namespace App\Http\Middleware;

use Closure;

class Honeypot
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
        // If something triggers a honeypot field, we'll just return an empty response and hopefully they'll move on...
        if (! is_null($request->get('name_h_p_check'))) {
            return response('');
        }
        return $next($request);
    }
}
