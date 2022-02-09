<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {


        if (\Auth::user()->hasPermission($permission)){
            return $next($request); 
        } else {
            return abort(403);
        }
        /*
        
        #return $next($request);
        if (\Auth::check() && \Auth::user()->is_admin == 1){
            return $next($request);
          } else {
            return redirect('/home');
        }
        */
    }
}
