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
use App\Models\OutwardType2;

use Illuminate\Support\Facades\Auth;

class OutwardController extends Controller
{
    public function outward_view_t1(Request $request)
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

        return view('outward.outwardtype1', compact('centers' , 'vehicles', 'helpers', 'drivers'));
    }

    public function outward_view_t2(Request $request)
    {
        $hasPermission = Auth::user()->hasPermission("add outward type 2") || Auth::user()->id == 1;
        if (!$hasPermission) {
            return redirect("/not_allowed");
        }
        // fetch all centers (active first, for example)
        $centers = Center::orderBy('center_name', 'ASC')->where('status', 1)->get();
        // fetch all vehicles (active first, for example)
        $vehicles = Vehicle::where('status', 'Active')->orderBy('vehicle_no', 'ASC')->get();
        // fetch all vehicles (active first, for example)
        $vehicles = Vehicle::orderBy('type', 'ASC')->where('status', 'Active')->get();
        // fetch all Drivers (active first, for example)
        $drivers = Driver::orderBy('name', 'ASC')->where('status', 1)->get();
        // fetch all Helpers (active first, for example)
        $helpers = Helper::orderBy('name', 'ASC')->where('status', 1)->get();
        // Generate next outward number
      
        $outward_no = OutwardType2::booted();

        return view('outward.outwardtype2', compact('centers', 'vehicles', 'helpers', 'drivers', 'outward_no'));
    }

    public function outward_type2_store(Request $request)
    {
        $hasPermission = Auth::user()->hasPermission("add outward type 2") || Auth::user()->id == 1;
        if (!$hasPermission) {
            return redirect("/not_allowed");
        }

        $request->validate([
            'center_id' => 'required',
            'type' => 'required',
            'vehicle_id' => 'required',
            'date' => 'required',
            'driver_id' => 'required',
            'helper_id' => 'required',
            'vehicle_type' => 'required',
          
            'time_out' => 'required',
          
            'meter_out' => 'required',
            
        ]);

        OutwardType2::create([
            'center_id' => $request->center_id,
            'type' => $request->type,
            'vehicle_id' => $request->vehicle_id,
            'date' => $request->date,
            'driver_id' => $request->driver_id,
            'helper_id' => $request->helper_id,
            'vehicle_type' => $request->vehicle_type,
            'time_in' => $request->time_in ?? now()->format('H:i'),
            'time_out' => $request->time_out,
            'meter_in' => $request->meter_in,
            'meter_out' => $request->meter_out,
            'comments' => $request->comments,
            'outward_no' => $request->outward_no,
        ]);

        return redirect()->back()->with('success', 'Outward Type 2 saved successfully!');
    }
}

