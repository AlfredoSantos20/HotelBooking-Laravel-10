<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Session;
use Illuminate\Support\Facades\Artisan;

class MaintenanceController extends Controller
{
    public function maintenance(){
        return view('Frontend.maintenance');
    }
    public function toggleMaintenance()
    {
        // Toggle the maintenance mode in the session
        $currentMode = session('maintenance_mode', false);
        session(['maintenance_mode' => !$currentMode]);

        // Redirect back with a status message
        $statusMessage = $currentMode ? 'Maintenance mode is now OFF.' : 'Maintenance mode is now ON.';
        return redirect()->back()->with('status', $statusMessage);
    }



}
