<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserHasHotel {

    public function handle(Request $request, Closure $next): Response {

        if (!auth()->user()?->hotel) {
            return redirect()->route('hotels.create');
        }

        if ($request->route()->getName() == 'hotels.create' && auth()->user()->hotel) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
