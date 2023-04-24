<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IfNotAdmin
{
	public function handle($request, Closure $next)
	{
		if (Auth::id() != 1 && Auth::id() == 2) {
			return Redirect::route('home');
		}
		return $next($request);
	}
}
