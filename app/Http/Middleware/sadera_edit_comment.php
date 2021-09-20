<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\SaderaComment;
class sadera_edit_comment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     //usertype 2 is archive user 
     //usertype 1 is superdmin
     //usertype 0 is normal user

    public function handle($request, Closure $next)
    {

        $comment = SaderaComment::where('user_id', $request->user_id)->first();
        
        if($comment->user_id === Auth::user()->id){
             return $next($request);
        } else {
            return abort(401, 'دسترسی غیر مجاز');  
        }

         
    }




}
