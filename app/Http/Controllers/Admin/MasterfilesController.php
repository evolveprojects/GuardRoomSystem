<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userlevel;
use App\Models\User;
use App\Models\Center;
use App\Models\Vehicle;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Driver\Driver;

class MasterfilesController extends Controller
{

    public function userlevel(Request $request)
    {
        $searchKey = $request->searchKey;
        $getuserlevels = Userlevel::where('level_name', 'like', '%' . $searchKey . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(env("RECORDS_PER_PAGE"));

        return view('masterfiles.userlevels', compact(['getuserlevels', 'searchKey']));
    }

    public function users(Request $request)
    {
        $searchKey = $request->searchKey;
        $user = User::where('name', 'like', '%' . $searchKey . '%')
            ->orderBy('created_at', 'ASC')
            ->paginate(env("RECORDS_PER_PAGE"));

          $permissions = Permission::get()->groupBy('permission_type')->toArray();

        return view('masterfiles.users', compact(['user', 'searchKey','permissions']));
    }

    public function centers(Request $request)
    {
        $searchKey = $request->searchKey;
        $centers = Center::where('center_name', 'like', '%' . $searchKey . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(env("RECORDS_PER_PAGE"));

        return view('masterfiles.centers', compact(['centers', 'searchKey']));
    }

    public function vehicles(Request $request)
    {
        $searchKey = $request->searchKey;
        $vehicles = Vehicle::where('vehicle_no', 'like', '%' . $searchKey . '%')
            ->orWhere('type', 'like', '%' . $searchKey . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(env("RECORDS_PER_PAGE"));

        return view('masterfiles.vehicles', compact(['vehicles', 'searchKey']));
    }

    public function drivers(Request $request)
    {
        return view('masterfiles.drivers');
    }

    public function helpers()
    {
        return view('masterfiles.helpers');
    }

    public function securities()
    {
        return view('masterfiles.securities');
    }


    public function adduserlevel(Request $request)
    {

        // $hasPermission = Auth::user()->hasPermission("create_vendor");

        // if ($hasPermission) {

        $validated = $request->validate([
            'level_code' => ['required', 'string'],
            'level_name' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);


        $userlevel = new Userlevel();
        $userlevel->level_name = $request->level_name;
        $userlevel->level_code = $request->level_code;
        $userlevel->description = $request->description;
        $userlevel->status = 1;
        $userlevel->created_by = Auth::id();
        $userlevel->save();



        return back()->with('success', 'UserLevel added  successfully !');
        // } else {
        //     return redirect("admin/not_allowed");
        // }
    }

    public function updateuserlevel(Request $request)
    {

        // $hasPermission = Auth::user()->hasPermission("edit_userlevel");

        // if ($hasPermission) {

        $validated = $request->validate([
            'level_code' => ['required', 'string'],
            'level_name' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);

        $userlevel = Userlevel::where('id', $request->id)->get()->first();

        if ($userlevel != null) {

            $userlevel->level_name = $request->level_name;
            $userlevel->level_code = $request->level_code;
            $userlevel->description = $request->description;
            $userlevel->status = 1;
            $userlevel->updated_by = Auth::id();
            $userlevel->save();

            return back()->with('success', 'Userlevel updated successfully !');
        } else {
            return back()->with("error", "Could not find the Userlevel");
        }
        // } else {
        //     return redirect("admin/not_allowed");
        // }
    }

    public function addCenter(Request $request)
    {
        $validated = $request->validate([
            'center_id' => ['required', 'string'],
            'center_name' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);

        $center = new Center();
        $center->center_id = $request->center_id;
        $center->center_name = $request->center_name;
        $center->status = $request->status;
        $center->created_by = Auth::id();
        $center->save();

        return back()->with('success', 'Center added successfully!');
    }

    public function updateCenter(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required'],
            'center_id' => ['required', 'string'],
            'center_name' => ['required', 'string'],
            'status' => ['required'],
        ]);

        $center = Center::find($request->id);

        if (!$center) {
            return back()->with('error', 'Center not found.');
        }

        $center->center_id = $request->center_id;
        $center->center_name = $request->center_name;
        $center->status = $request->status;
        $center->updated_by = Auth::id();
        $center->save();

        return back()->with('success', 'Center updated successfully!');
    }

    public function addVehicle(Request $request)
    {
        $validated = $request->validate([
            'vehicle_no' => ['required', 'string', 'unique:vehicles,vehicle_no'],
            'type' => ['required', 'string'],
            'fuel_type' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);

        $vehicle = new Vehicle();
        $vehicle->vehicle_no = $request->vehicle_no;
        $vehicle->type = $request->type;
        $vehicle->brand = $request->brand;
        $vehicle->model = $request->model;
        $vehicle->color = $request->color;
        $vehicle->fuel_type = $request->fuel_type;
        $vehicle->status = $request->status;
        $vehicle->created_by = Auth::id();
        $vehicle->save();

        return back()->with('success', 'Vehicle added successfully!');
    }

    public function updateVehicle(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'exists:vehicles,id'], // corrected 'exits' → 'exists'
            'vehicle_no' => ['required', 'string', 'unique:vehicles,vehicle_no,' . $request->id], // exclude current id
            'type' => ['required', 'string'],
            'fuel_type' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);

        $vehicle = Vehicle::find($request->id);

        if (!$vehicle) {
            return back()->with('error', 'Vehicle not found.');
        }

        $vehicle->vehicle_no = $request->vehicle_no;
        $vehicle->type = $request->type;
        $vehicle->brand = $request->brand;
        $vehicle->model = $vehicle->model;
        $vehicle->color = $vehicle->color;
        $vehicle->fuel_type = $request->fuel_type;
        $vehicle->status = $request->status;
        $vehicle->updated_by = Auth::id();
        $vehicle->save();

        return back()->with('success', 'Vehicle updated successfully!');
    }
}
