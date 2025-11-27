<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userlevel;
use App\Models\User;
use App\Models\Center;
use App\Models\Vehicle;
use App\Models\Permission;
use App\Models\Driver;
use App\Models\Helper;
use App\Models\Security;
use Illuminate\Support\Facades\Auth;


class InwardController extends Controller
{
    public function inward_view(Request $request)
    {
        // fetch all centers (active first, for example)
        $centers = Center::orderBy('center_name', 'ASC')->get();
        // fetch all vehicles (active first, for example)
        $vehicles = Vehicle::orderBy('vehicle_no', 'ASC')->get();
        // fetch all vehicles (active first, for example)
        $vehicles = Vehicle::orderBy('type', 'ASC')->get();
        // fetch all Helpers (active first, for example)
        $helpers = Helper::orderBy('name', 'ASC')->get();
        // fetch all Drivers (active first, for example)
        $drivers = Driver::orderBy('name', 'ASC')->get();

        return view('inward.inward', compact('centers', 'vehicles', 'helpers', 'drivers'));
    }
}
