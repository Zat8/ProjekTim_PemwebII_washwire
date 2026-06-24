<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if (!in_array($request->user()->role, $roles)) {
            return redirect()->route('dashboard')
                ->with('warning', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}
