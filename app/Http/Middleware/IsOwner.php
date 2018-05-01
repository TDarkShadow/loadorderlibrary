<?php

namespace App\Http\Middleware;

use Closure;

class IsOwner
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
		$url = $request->url();

		$url = explode('/', $url);

		//dd($url[4]);

		//echo rawurlencode(\Auth::user()->username);

		//dd();

		if(!(rawurlencode(\Auth::user()->username) == $url[4]))
		{
			return redirect('/u/' . rawurlencode(\Auth::user()->username) . '/' . $url[5]);
		} 

        return $next($request);
    }
}
