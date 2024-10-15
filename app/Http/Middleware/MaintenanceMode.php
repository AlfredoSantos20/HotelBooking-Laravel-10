<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Log;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the site is in maintenance mode
        if (Session::get('maintenance_mode')) {
            // Allow access to the maintenance page
            if ($request->is('maintenance')) {
                return $next($request);
            }

            // Redirect all other requests to the maintenance page
            return redirect()->route('maintenance');
        }

        // If not in maintenance mode, do not allow access to the maintenance page
        if ($request->is('maintenance')) {
            return redirect('/');
        }

        // If not in maintenance mode, allow the request to proceed
        return $next($request);
    }



}
