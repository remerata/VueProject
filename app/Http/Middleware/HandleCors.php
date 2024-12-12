<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleCors
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*') // Allow all origins or specify specific origin like 'http://localhost:5173'
            ->header('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, OPTIONS') // Allow specific methods
            ->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization'); // Allow specific headers
    }
}
