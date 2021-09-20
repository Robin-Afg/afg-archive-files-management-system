<?php

namespace App\Http\Middleware;

use Closure;
use Auth; 

class isVadmin
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
        if(Auth::user()->type === 1 || Auth::user()->type === 3 )
        {
            return $next($request);  
         }
         else 
         {
            return abort(401, 'دسترسی غیر مجاز');  
        }
    }
}
