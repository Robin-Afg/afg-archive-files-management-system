<?php

namespace App\Http\Middleware;

use Closure;

class check_download
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
        

          if ($request->exchange_key != session('s_key')) {
            return abort(401, 'دسترسی غیر مجاز');  
        }
        
        return $next($request);
    }
}
