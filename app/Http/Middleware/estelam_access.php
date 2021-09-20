<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\EstelamUser;
use Auth;


class estelam_access
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
        $estelam_id = $request->file;
        $result = EstelamUser::where('estelam_id',  $estelam_id)->where('user_id',Auth::id())->get();
       //allows to view the specific file if a user is an archive user an administrator or has access on the record
        
        if( (!$result->isEmpty())  || Auth::user()->type === 1 || Auth::user()->type === 2 || Auth::user()->type === 3){
          return $next($request);
        }
        return abort(401, 'دسترسی غیر مجاز');  
    }
}
