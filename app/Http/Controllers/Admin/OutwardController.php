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
use App\Models\Outwardmodel_type1_t1;
use App\Models\Outwardmodel_type1_t2;
use App\Http\Controllers\Admin\ShipmentController;
use DB;

class OutwardController extends Controller
{
    public function outward_view_t1(Request $request, ShipmentController $shipmentController)
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
        $outno = Outwardmodel_type1_t1::generateoutno();


        $AOD_no = $shipmentController->getShipmentsno();
        $items = $shipmentController->getShipmentsitems();
        $customers = $shipmentController->getShipmentscustomers();
        // dd($items);
        return view('outward.outwardtype1', compact('centers', 'vehicles', 'helpers', 'drivers', 'outno', 'AOD_no', 'items', 'customers'));
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
        // $vehicles = Vehicle::where('status', 1)
        //     ->orderBy('vehicle_no', 'ASC')
        //     ->get();
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


    public function saveoutward_type_1(Request $request)
    {

        $hasPermission = (Auth::user()->hasPermission("Save Outward Type 1") || Auth::user()->id == '1');

        if ($hasPermission) {

            $validated = $request->validate([
                'outward_number' => ['required', 'string'],
                'center' => ['required', 'string'],
                'vehicle_no' => ['required', 'string'],
                'weight' => ['required', 'string'],
                'date' => ['required', 'string'],
                'time_out' => ['required', 'string'],
                'driver' => ['required', 'string'],
                'helper' => ['required', 'string'],
                'meter_out' => ['required', 'string'],

            ]);
            // Call the insertData method and handle its response
            $result = $this->insertData($request);

            if ($result->getData()->success) {
                if ($request->save_close == 'save_close') {
                    return redirect()->route('outward.outward_view_All')->with('success', 'Job  saved successfully!');
                } else {
                    return back()->with('success', 'Job  saved successfully!');
                }
            } else {
                return back()->with('error', 'Failed to save the Job . Please try again.');
            }
        } else {
            return redirect("/not_allowed");
        }
    }

    public function insertData(Request $request)
    {



        DB::beginTransaction();
        try {

            $lastInsertId = $this->jobSave1($request);
            $this->jobSave2($request, $lastInsertId);


            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function jobSave1(Request $request)
    {



        $data1 = [

            'outward_number' => $request->outward_number,
            'center' => $request->center,
            'vehicle_no' => $request->vehicle_no,
            'weight' => $request->weight,
            'date' => $request->date,
            'driver' => $request->driver,
            'helper' => $request->helper,
            'vehicle_type' => $request->vehicle_type,
            'time_in' => $request->time_in,
            'time_out' => $request->time_out,
            'meter_in' => $request->meter_in,
            'meter_out' => $request->meter_out,
            'comment' => $request->comment,
            'status' => '0',
            'type' => '1',
            'created_by' => Auth::id(),

        ];

        $job = Outwardmodel_type1_t1::create($data1);
        return $job->id;
    }

    private function jobSave2(Request $request, $lastInsertId)
    {
        $rowCount = $request->rowCount1;
        for ($i = 0; $i < $rowCount; $i++) {
            if (!empty($request->input('aod_td' . $i))) {
                $data3 = [
                    'outward_id' => $lastInsertId,
                    'aod_td' => $request->input('aod_td' . $i),
                    'item_se' => $request->input('item_se' . $i),
                    'qty_se' => $request->input('qty_se' . $i),
                    'amount_se' => $request->input('amount_se' . $i),
                    'customer_se' => $request->input('customer_se' . $i),

                ];
                Outwardmodel_type1_t2::create($data3);
            }
        }
    }

    public function outward_view_All(Request $request)
    {
        // fetch all centers (active first, for example)
        $searchKey = $request->searchKey;
        $out_data = DB::table('outwardmodel_type1_t1s')
            ->select([
                'outwardmodel_type1_t1s.*',
                'vehicles.vehicle_no',
                'helpers.name as helper_name',
                'centers.center_name',
                'drivers.name as driver_name',
                'users.name as created_by_name'
            ])
            ->leftJoin('vehicles', 'outwardmodel_type1_t1s.vehicle_no', '=', 'vehicles.id')
            ->leftJoin('helpers', 'outwardmodel_type1_t1s.helper', '=', 'helpers.id')
            ->leftJoin('centers', 'outwardmodel_type1_t1s.center', '=', 'centers.id')
            ->leftJoin('drivers', 'outwardmodel_type1_t1s.driver', '=', 'drivers.id')
            ->leftJoin('users', 'outwardmodel_type1_t1s.created_by', '=', 'users.id')
            ->when($searchKey, function ($query, $searchKey) {

                return $query->where('outwardmodel_type1_t1s.outward_number', 'like', '%' . $searchKey . '%');
            })
            ->orderBy('outwardmodel_type1_t1s.created_at', 'DESC')
            ->paginate(config('app.records_per_page', 10));

        return view('outward.all_outward', compact(['out_data']));
    }
    public function vehicledata(Request $request)
    {


        $vehicle_no = $request->vehicle_no;

        // Find vehicle by vehicle number
        $vehicle = Vehicle::where('id', $vehicle_no)->first();

        if ($vehicle) {
            return response()->json([
                'status' => 'success',
                'vehicle' => [
                    'id' => $vehicle->id,
                    'vehicle_no' => $vehicle->vehicle_no,
                    'vehicle_type' => $vehicle->type,

                    // Add other fields as needed
                ]
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehicle not found'
            ], 404);
        }
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

        // ASSIGN the created record to $outward variable
        $outward = OutwardType2::create([
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
            'status' => '0',
            'created_by' => Auth::id(),
        ]);

        // If type is "Company", save the table items
        if ($request->type === 'Company' && $request->has('rowCount1') && intval($request->rowCount1) > 0) {
            // Add outward_id to the request
            $request->merge(['outward_id' => $outward->id]);

            // Call the t2 method to save items
            $this->outward_type2_t2($request);
        }

        return redirect()->back()->with('success', 'Outward Type 2 saved successfully!');
    }

    public function outward_type2_t2(Request $request)
    {
        // Get outward_id (from merged request or route parameter)
        $outwardId = $request->outward_id ?? $request->route('outward_id');

        if (!$outwardId) {
            return redirect()->back()->with('error', 'Outward ID is required!');
        }

        $outward = \App\Models\OutwardType2::findOrFail($outwardId);

        // Delete existing t2 items
        $outward->t2Items()->delete();

        // Get all input data and find all row indices
        $savedCount = 0;

        // Loop through possible indices (handles non-sequential row numbers)
        for ($i = 0; $i < 1000; $i++) {
            // Check if this row index exists in the request
            if (
                $request->has("center_td{$i}") ||
                $request->has("item_se{$i}") ||
                $request->has("qty_se{$i}") ||
                $request->has("amount_se{$i}")
            ) {

                $center = $request->input("center_td{$i}");
                $item = $request->input("item_se{$i}");
                $qty = $request->input("qty_se{$i}");
                $amount = $request->input("amount_se{$i}");

                // Only save if at least one field has data
                if ($center || $item || $qty || $amount) {
                    $outward->t2Items()->create([
                        'center' => $center,
                        'item' => $item,
                        'quantity' => $qty ? intval($qty) : null,
                        'amount' => $amount ? floatval(str_replace(',', '', $amount)) : null,
                    ]);
                    $savedCount++;
                }
            }
        }

        \Log::info("Saved {$savedCount} items for outward ID: {$outwardId}");

        // Only redirect if called directly (not from store method)
        if (!$request->has('outward_id')) {
            return redirect()->back()->with('success', "Company items saved successfully! ({$savedCount} items)");
        }
    }


    public function allOutwards(Request $request)
    {
        $searchKey = $request->input('searchKey');

        // Fetch all outward type 2 records
        $out_data = DB::table('outward_type2')
            ->join('centers', 'outward_type2.center_id', '=', 'centers.id')
            ->join('vehicles', 'outward_type2.vehicle_id', '=', 'vehicles.id')
            ->join('drivers', 'outward_type2.driver_id', '=', 'drivers.id')
            ->join('helpers', 'outward_type2.helper_id', '=', 'helpers.id')
            ->join('users', 'outward_type2.created_by', '=', 'users.id')
            ->select(
                'outward_type2.*',
                'centers.center_name',
                'vehicles.vehicle_no',
                'drivers.name as driver_name',
                'helpers.name as helper_name',
                'users.name as created_by_name'
            )
            ->when($searchKey, function ($query, $searchKey) {
                $query->where('outward_type2.outward_no', 'like', "%$searchKey%")
                    ->orWhere('centers.center_name', 'like', "%$searchKey%")
                    ->orWhere('vehicles.vehicle_no', 'like', "%$searchKey%")
                    ->orWhere('drivers.name', 'like', "%$searchKey%")
                    ->orWhere('helpers.name', 'like', "%$searchKey%");
            })
            ->orderBy('outward_type2.id', 'desc')
            ->get();

        // IMPORTANT: Manually load t2Items for each outward record
        foreach ($out_data as $data) {
            $data->t2Items = \App\Models\OutwardType2T2::where('outward_id', $data->id)->get();
        }

        // Fetch data needed for edit modals
        $centers = \App\Models\Center::all();
        $vehicles = \App\Models\Vehicle::all();
        $drivers = \App\Models\Driver::all();
        $helpers = \App\Models\Helper::all();

        return view('outward.all', compact('out_data', 'searchKey', 'centers', 'vehicles', 'drivers', 'helpers'));
    }

    public function outward_type2_update(Request $request)
    {
        $hasPermission = Auth::user()->hasPermission("edit outward type 2") || Auth::user()->id == 1;
        if (!$hasPermission) {
            return redirect("/not_allowed");
        }

        $validated = $request->validate([
            'id' => 'required|exists:outward_type2,id',
            'center_id' => 'required',
            'type' => 'required',
            'vehicle_id' => 'required',
            'date' => 'required|date',
            'driver_id' => 'required',
            'helper_id' => 'required',
            'vehicle_type' => 'required',
            'time_out' => 'required',
            'meter_out' => 'required|numeric',
            'meter_in' => 'nullable|numeric',
            'time_in' => 'nullable',
        ]);

        $outward = OutwardType2::findOrFail($request->id);

        // Determine status: Completed if time_in AND meter_in are filled
        $status = '0'; // Default: Ongoing
        if ($request->filled('time_in') && $request->filled('meter_in')) {
            $status = '1'; // Completed
        }

        // Update main record
        $updateData = [
            'center_id' => $request->center_id,
            'type' => $request->type,
            'vehicle_id' => $request->vehicle_id,
            'date' => $request->date,
            'driver_id' => $request->driver_id,
            'helper_id' => $request->helper_id,
            'vehicle_type' => $request->vehicle_type,
            'time_out' => $request->time_out,
            'meter_out' => $request->meter_out,
            'meter_in' => $request->meter_in,
            'comments' => $request->comments,
            'status' => $status, // Add this line
            'updated_by' => Auth::id(),
        ];

        // Add time_in only if it has value
        if ($request->filled('time_in')) {
            $updateData['time_in'] = $request->time_in;
        } else {
            $updateData['time_in'] = null;
        }

        // Save the update
        $updated = $outward->update($updateData);

        \Log::info('Update result:', ['success' => $updated, 'outward_id' => $outward->id, 'status' => $status]);

        // Handle company items
        if ($request->type === 'Company') {
            // Delete old items
            $outward->t2Items()->delete();

            // Add new items if there are any
            if ($request->has('rowCount1') && intval($request->rowCount1) > 0) {
                $request->merge(['outward_id' => $outward->id]);
                $this->outward_type2_t2($request);
            }
        } else {
            // If changed from Company to Passenger, delete all items
            $outward->t2Items()->delete();
        }

        return redirect()->route('outward.all')->with('success', 'Outward updated successfully!');
    }
    public function edit($id)
    {
        $outward = OutwardType2::with('t2Items')->findOrFail($id);

        $centers = Center::all();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $helpers = Helper::all();

        // return view('outward.edit_type2_page', ...) <-- old
        return view('outward.edit_type2', compact(
            'outward',
            'centers',
            'vehicles',
            'drivers',
            'helpers'
        ));
    }


    // public function update(Request $request)
    // {
    //     $outward = OutwardType2::findOrFail($request->id);

    //     $outward->center_id = $request->center_id;
    //     $outward->type = $request->type;
    //     $outward->vehicle_id = $request->vehicle_id;
    //     $outward->driver_id = $request->driver_id;
    //     $outward->helper_id = $request->helper_id;
    //     $outward->comments = $request->comments;

    //     $outward->save();

    //     return redirect()->route('outward.all')
    //         ->with('success', 'Outward updated successfully!');
    // }

    public function outward_edit_t1(ShipmentController $shipmentController, $id)
    {

        // fetch all centers (active first, for example)
        $centers = Center::orderBy('center_name', 'ASC')->get();
        // fetch all vehicles (active first, for example)
        $vehicles = Vehicle::orderBy('vehicle_no', 'ASC')->get();
        // fetch all vehicles (active first, for example)

        // fetch all Helpers (active first, for example)
        $helpers = Helper::orderBy('name', 'ASC')->get();
        // fetch all Drivers (active first, for example)
        $drivers = Driver::orderBy('name', 'ASC')->get();
        $outno = Outwardmodel_type1_t1::generateoutno();

        $item1 = Outwardmodel_type1_t1::findOrFail($id);
        $item2 = Outwardmodel_type1_t2::where('outward_id', $id)->get();


        $AOD_no = $shipmentController->getShipmentsno();
        $items = $shipmentController->getShipmentsitems();
        $customers = $shipmentController->getShipmentscustomers();
        return view('outward.outwardtype1_edit', compact('centers', 'vehicles', 'helpers', 'drivers', 'outno', 'AOD_no', 'item1', 'item2','items','customers'));
    }

    public function  editoutward_type_1(Request $request)
    {

        $hasPermission = (Auth::user()->hasPermission("Edit Outward Type 1") || Auth::user()->id == '1');

        if ($hasPermission) {

            $validated = $request->validate([
                'outward_number' => ['required', 'string'],
                'center' => ['required', 'string'],
                'vehicle_no' => ['required', 'string'],
                'date' => ['required', 'string'],
                'time_in' => ['required', 'string'],
                'driver' => ['required', 'string'],
                'helper' => ['required', 'string'],
                'meter_in' => ['required', 'string'],

            ]);
            // Call the insertData method and handle its response
            $result = $this->updateData($request);

            if ($result->getData()->success) {
                if ($request->update_close == 'update_close') {
                    return redirect()->route('outward.outward_view_All')->with('success', 'Job  Updated successfully!');
                } else {
                    return back()->with('success', 'Job  Updated successfully!');
                }
            } else {
                return back()->with('error', 'Failed to save the Job . Please try again.');
            }
        } else {
            return redirect("/not_allowed");
        }
    }

    public function updateData(Request $request)
    {



        DB::beginTransaction();
        try {

            $this->jobupdate1($request);
            $this->jobupdate2($request);


            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function jobupdate1(Request $request)
    {



        $data1 = [

            'outward_number' => $request->outward_number,
            'center' => $request->center,
            'vehicle_no' => $request->vehicle_no,
            'date' => $request->date,
            'driver' => $request->driver,
            'helper' => $request->helper,
            'vehicle_type' => $request->vehicle_type,
            'time_in' => $request->time_in,
            'time_out' => $request->time_out,
            'meter_in' => $request->meter_in,
            'meter_out' => $request->meter_out,
            'comment' => $request->comment,
            'status' => '1',
            'type' => '1',
            'created_by' => Auth::id(),

        ];

        $job = Outwardmodel_type1_t1::where('id', $request->id)->update($data1);
    }

    private function jobupdate2(Request $request)
    {
        $rowCount = $request->rowCount1;
        Outwardmodel_type1_t2::where('outward_id', $request->id)->delete();
        for ($i = 0; $i < $rowCount; $i++) {
            if (!empty($request->input('aod_td' . $i))) {
                $data3 = [
                    'outward_id' => $request->id,
                    'aod_td' => $request->input('aod_td' . $i),
                    'item_se' => $request->input('item_se' . $i),
                    'qty_se' => $request->input('qty_se' . $i),
                    'amount_se' => $request->input('amount_se' . $i),
                    'customer_se' => $request->input('customer_se' . $i),

                ];
                Outwardmodel_type1_t2::create($data3);
            }
        }
    }
}

    public function outward_type2_t2(Request $request)
    {
        // Get outward_id (from merged request or route parameter)
        $outwardId = $request->outward_id ?? $request->route('outward_id');

        if (!$outwardId) {
            return redirect()->back()->with('error', 'Outward ID is required!');
        }

        $outward = \App\Models\OutwardType2::findOrFail($outwardId);

        // Delete existing t2 items
        $outward->t2Items()->delete();

        // Get all input data and find all row indices
        $savedCount = 0;

        // Loop through possible indices (handles non-sequential row numbers)
        for ($i = 0; $i < 1000; $i++) {
            // Check if this row index exists in the request
            if (
                $request->has("center_td{$i}") ||
                $request->has("item_se{$i}") ||
                $request->has("qty_se{$i}") ||
                $request->has("amount_se{$i}")
            ) {

                $center = $request->input("center_td{$i}");
                $item = $request->input("item_se{$i}");
                $qty = $request->input("qty_se{$i}");
                $amount = $request->input("amount_se{$i}");

                // Only save if at least one field has data
                if ($center || $item || $qty || $amount) {
                    $outward->t2Items()->create([
                        'center' => $center,
                        'item' => $item,
                        'quantity' => $qty ? intval($qty) : null,
                        'amount' => $amount ? floatval(str_replace(',', '', $amount)) : null,
                    ]);
                    $savedCount++;
                }
            }
        }

        \Log::info("Saved {$savedCount} items for outward ID: {$outwardId}");

        // Only redirect if called directly (not from store method)
        if (!$request->has('outward_id')) {
            return redirect()->back()->with('success', "Company items saved successfully! ({$savedCount} items)");
        }
    }


    public function allOutwards(Request $request)
    {
        $searchKey = $request->input('searchKey');

        // Fetch all outward type 2 records
        $out_data = DB::table('outward_type2')
            ->join('centers', 'outward_type2.center_id', '=', 'centers.id')
            ->join('vehicles', 'outward_type2.vehicle_id', '=', 'vehicles.id')
            ->join('drivers', 'outward_type2.driver_id', '=', 'drivers.id')
            ->join('helpers', 'outward_type2.helper_id', '=', 'helpers.id')
            ->join('users', 'outward_type2.created_by', '=', 'users.id')
            ->select(
                'outward_type2.*',
                'centers.center_name',
                'vehicles.vehicle_no',
                'drivers.name as driver_name',
                'helpers.name as helper_name',
                'users.name as created_by_name'
            )
            ->when($searchKey, function ($query, $searchKey) {
                $query->where('outward_type2.outward_no', 'like', "%$searchKey%")
                    ->orWhere('centers.center_name', 'like', "%$searchKey%")
                    ->orWhere('vehicles.vehicle_no', 'like', "%$searchKey%")
                    ->orWhere('drivers.name', 'like', "%$searchKey%")
                    ->orWhere('helpers.name', 'like', "%$searchKey%");
            })
            ->orderBy('outward_type2.id', 'desc')
            ->get();

        // IMPORTANT: Manually load t2Items for each outward record
        foreach ($out_data as $data) {
            $data->t2Items = \App\Models\OutwardType2T2::where('outward_id', $data->id)->get();
        }

        // Fetch data needed for edit modals
        $centers = \App\Models\Center::all();
        $vehicles = \App\Models\Vehicle::all();
        $drivers = \App\Models\Driver::all();
        $helpers = \App\Models\Helper::all();

        return view('outward.all', compact('out_data', 'searchKey', 'centers', 'vehicles', 'drivers', 'helpers'));
    }

    public function outward_type2_update(Request $request)
    {
        $hasPermission = Auth::user()->hasPermission("edit outward type 2") || Auth::user()->id == 1;
        if (!$hasPermission) {
            return redirect("/not_allowed");
        }

        $validated = $request->validate([
            'id' => 'required|exists:outward_type2,id',
            'center_id' => 'required',
            'type' => 'required',
            'vehicle_id' => 'required',
            'date' => 'required|date',
            'driver_id' => 'required',
            'helper_id' => 'required',
            'vehicle_type' => 'required',
            'time_out' => 'required',
            'meter_out' => 'required|numeric',
            'meter_in' => 'nullable|numeric',
            'time_in' => 'nullable',
        ]);

        $outward = OutwardType2::findOrFail($request->id);

        // Determine status: Completed if time_in AND meter_in are filled
        $status = '0'; // Default: Ongoing
        if ($request->filled('time_in') && $request->filled('meter_in')) {
            $status = '1'; // Completed
        }

        // Update main record
        $updateData = [
            'center_id' => $request->center_id,
            'type' => $request->type,
            'vehicle_id' => $request->vehicle_id,
            'date' => $request->date,
            'driver_id' => $request->driver_id,
            'helper_id' => $request->helper_id,
            'vehicle_type' => $request->vehicle_type,
            'time_out' => $request->time_out,
            'meter_out' => $request->meter_out,
            'meter_in' => $request->meter_in,
            'comments' => $request->comments,
            'status' => $status, // Add this line
            'updated_by' => Auth::id(),
        ];

        // Add time_in only if it has value
        if ($request->filled('time_in')) {
            $updateData['time_in'] = $request->time_in;
        } else {
            $updateData['time_in'] = null;
        }

        // Save the update
        $updated = $outward->update($updateData);

        \Log::info('Update result:', ['success' => $updated, 'outward_id' => $outward->id, 'status' => $status]);

        // Handle company items
        if ($request->type === 'Company') {
            // Delete old items
            $outward->t2Items()->delete();

            // Add new items if there are any
            if ($request->has('rowCount1') && intval($request->rowCount1) > 0) {
                $request->merge(['outward_id' => $outward->id]);
                $this->outward_type2_t2($request);
            }
        } else {
            // If changed from Company to Passenger, delete all items
            $outward->t2Items()->delete();
        }

        return redirect()->route('outward.all')->with('success', 'Outward updated successfully!');
    }
    public function edit($id)
    {
        $outward = OutwardType2::with('t2Items')->findOrFail($id);

        $centers = Center::all();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $helpers = Helper::all();

        // return view('outward.edit_type2_page', ...) <-- old
        return view('outward.edit_type2', compact(
            'outward',
            'centers',
            'vehicles',
            'drivers',
            'helpers'
        ));
    }


    // public function update(Request $request)
    // {
    //     $outward = OutwardType2::findOrFail($request->id);

    //     $outward->center_id = $request->center_id;
    //     $outward->type = $request->type;
    //     $outward->vehicle_id = $request->vehicle_id;
    //     $outward->driver_id = $request->driver_id;
    //     $outward->helper_id = $request->helper_id;
    //     $outward->comments = $request->comments;

    //     $outward->save();

    //     return redirect()->route('outward.all')
    //         ->with('success', 'Outward updated successfully!');
    // }
}
