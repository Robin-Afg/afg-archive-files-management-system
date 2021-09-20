<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class LastUserActivity
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
        //test if a user is online and puts something in the cache it will be user by online method user in 
        //user class
        if(Auth::check()){
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online' . Auth::id(), true, $expiresAt);
        }

        return $next($request);
    }
}
