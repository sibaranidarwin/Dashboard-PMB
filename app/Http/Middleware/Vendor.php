<?php

namespace App\Http\Middleware;

use Closure;

class Vendor
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
        {if (auth()->user()->level == "accounting") {
            return $next($request);
        }
        return redirect('/
        ')->with('error',"You dont have Access.");
    }
}
}
