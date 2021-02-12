<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $type)
    {
        $types = [
            'organizer' => ['organizer', 'admin', 'super'],
            'coach' => ['coach'],
            'admin' => ['admin', 'super'],
            'super' => ['super'],
        ];

        if(in_array(request()->user()->type, $types[$type])) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
