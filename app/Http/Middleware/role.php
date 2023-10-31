<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class role
{
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect('/login');
        }
        $role = auth()->user()->role;
        $allowed_roles = array_slice(func_get_args(), 2);
        if( in_array($role, $allowed_roles) ) {
            return $next($request);
        }else{
            return redirect()->back();
        }

    }
}
