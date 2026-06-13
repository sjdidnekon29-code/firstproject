<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Teacher;

class Roleteacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!auth()->check()) {

            return redirect()->route('login');
        }


        $user = auth()->user();

        if (!Teacher::where('email', $user->email)->exists()) {
            return redirect()->route('studentdashboard')
                ->with('error', 'Access denied.');
        }


        return $next($request);
    }
}
