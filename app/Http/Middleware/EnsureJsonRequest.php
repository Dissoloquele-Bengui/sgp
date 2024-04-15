<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureJsonRequest
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->wantsJson() || $request->isJson()) {
            return $next($request);
        }

        return response()->json(['error' => 'Unsupported Media Type'], 415);
    }
}
