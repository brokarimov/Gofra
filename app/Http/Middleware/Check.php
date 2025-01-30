<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Check
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $routeName = $request->route()->getName();

        if (Auth::check()) {
            
            if (Permission::where('key', $routeName)->first()) {
                $role = Auth::user()->roles;

                if ($role->permissions()->where('key', $routeName)->exists()) {
                    return $next($request);
                } else {
                    abort(403);
                }
            } else {
                abort(404);
            }
        }
        return redirect('/login');
    }
}
