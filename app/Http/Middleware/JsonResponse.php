<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class JsonResponse
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}