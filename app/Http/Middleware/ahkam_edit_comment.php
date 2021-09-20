<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AhkamComment;
use Auth;

class ahkam_edit_comment
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
        $comment = AhkamComment::where('user_id', $request->user_id)->first();
        
        if($comment->user_id === Auth::user()->id){
             return $next($request);
        } else {
            return abort(401, 'دسترسی غیر مجاز');  
        }
    }
}
