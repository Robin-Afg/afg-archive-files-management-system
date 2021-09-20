<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\SaderaComment;
class sadera_delete_comment
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

        $comment = SaderaComment::where('user_id', $request->user_id)->first();
        
        if($comment->user_id === Auth::user()->id || Auth::user()->type === 1){
             return $next($request);
        } else {
            return abort(401, 'دسترسی غیر مجاز');  
        }

         
    }
}
