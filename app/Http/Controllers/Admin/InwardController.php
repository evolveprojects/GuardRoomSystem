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
use App\Models\Inward;
use App\Models\InwardItem;
use Illuminate\Support\Facades\DB;
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

        $inward_no = Inward::generateInwardNo(); 

        return view('inward.inward', compact('centers', 'vehicles', 'helpers', 'drivers', 'inward_no'));
    }

    public function store(Request $request)
    {
        $hasPermission = Auth::user()->hasPermission("Add inward") || Auth::user()->user_type == 1;
        if (!$hasPermission) {
            return redirect("/not_allowed");
        }
        // Get the row count from hidden field
        $rowCount = $request->input('rowCount1', 0);

        // Validate main form fields
        $request->validate([
            'center' => 'required',
            'type' => 'required',
            'date' => 'required|date',
            'driver' => 'required',
            'helper' => 'required',
            'vehicle_id' => 'required',
            'bill' => 'required',
            'supplier' => 'required',
            'goods' => 'required',
            'member' => 'required',
        ]);

        // Build items array from individual fields
        $items = [];
        for ($i = 0; $i < $rowCount; $i++) {
            $itemName = $request->input("item_se{$i}");
            $quantity = $request->input("qty_se{$i}");
            $amount = $request->input("amount_se{$i}");

            // Only add items that have at least an item name
            if (!empty($itemName)) {
                $items[] = [
                    'item_name' => $itemName,
                    'quantity' => $quantity ?: 0,
                    'amount' => $amount ?: 0,
                ];
            }
        }

        // Validate that at least one item is provided
        if (empty($items)) {
            return redirect()->back()->with('error', 'At least one item is required.');
        }

        // Save Inward
       
        $inward = Inward::create([
            'center_id' => $request->center,
            'type' => $request->type,
            'date' => $request->date,
            'driver_id' => $request->driver,
            'helper_id' => $request->helper,
            'vehicle_id' => $request->vehicle_id,
            'bill_no' => $request->bill,
            'supplier' => $request->supplier,
            'goods_in_no' => $request->goods,
            'to_member' => $request->member,
            'comments' => $request->comment, // This matches the textarea name
            'status' => 'ongoing',
            'created_by' => Auth::id(),
        ]);

        // Save Items
        foreach ($items as $i => $item) {
            InwardItem::create([
                'inward_id' => $inward->id,
                'sr_no' => $i + 1,
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
                'amount' => $item['amount'],
            ]);
        }

        return redirect()->back()->with('success', 'Inward Saved Successfully!');
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

    public function inward_view_All(Request $request)
    {
        $searchKey = $request->searchKey;

        $query = Inward::with(['center', 'vehicle', 'driver', 'helper', 'createdBy'])
            ->orderBy('created_at', 'DESC');

        // Apply search if searchKey exists
        if ($searchKey) {
            $query->where(function ($q) use ($searchKey) {
                $q->where('inward_no', 'like', '%' . $searchKey . '%')
                    ->orWhereHas('center', function ($centerQuery) use ($searchKey) {
                        $centerQuery->where('center_name', 'like', '%' . $searchKey . '%');
                    });
            });
        }

        $in_data = $query->paginate(config('app.records_per_page', 10));

        return view('inward.all_inward', compact('in_data', 'searchKey'));
    }


    public function edit($id)
    {
        // Get the inward record
        $inward = Inward::with(['center', 'vehicle', 'driver', 'helper', 'items'])->findOrFail($id);

        // Fetch all related data
        $centers = Center::orderBy('center_name', 'ASC')->get();
        $vehicles = Vehicle::orderBy('vehicle_no', 'ASC')->get();
        $helpers = Helper::orderBy('name', 'ASC')->get();
        $drivers = Driver::orderBy('name', 'ASC')->get();

        return view('inward.edit', compact('inward', 'centers', 'vehicles', 'helpers', 'drivers'));
    }

    public function update(Request $request, $id)
    {

        $hasPermission = Auth::user()->hasPermission("Edit inward") || Auth::user()->user_type == 1;
        if (!$hasPermission) {
            return redirect("/not_allowed");
        }

        $inward = Inward::findOrFail($id);

        // 🔥 FIXED: Match your FORM field names exactly
        $request->validate([
            'center_id' => 'required',      // ← Changed from 'center'
            'type' => 'required',
            'date' => 'required|date',
            'driver_id' => 'required',      // ← Changed from 'driver'
            'helper_id' => 'required',      // ← Changed from 'helper'
            'vehicle_id' => 'required',
            'bill_no' => 'required',        // ← Changed from 'bill'
            'supplier' => 'required',
            'goods_in_no' => 'required',    // ← Changed from 'goods'
            'to_member' => 'required',      // ← Changed from 'member'
            'vehicle_type' => 'required',
        ]);

        // 🔥 FIXED: Use correct field names in update
        $inward->update([
            'center_id' => $request->center_id,     // ← Fixed
            'type' => $request->type,
            'date' => $request->date,
            'driver_id' => $request->driver_id,     // ← Fixed
            'helper_id' => $request->helper_id,     // ← Fixed
            'vehicle_id' => $request->vehicle_id,
            'vehicle_type' => $request->vehicle_type,
            'bill_no' => $request->bill_no,         // ← Fixed
            'supplier' => $request->supplier,
            'goods_in_no' => $request->goods_in_no, // ← Fixed
            'to_member' => $request->to_member,     // ← Fixed
            'comments' => $request->comments,       // ← Fixed (was comment)
            'status' => 'completed',
            'updated_by' => Auth::id(),
        ]);

        // Rest of your items code remains SAME...
        // Delete existing items
        InwardItem::where('inward_id', $inward->id)->delete();

        // Build items array (your existing code is perfect)
        $items = [];
        for ($i = 0; $i < 1000; $i++) {
            $itemName = $request->input("item_se{$i}");
            if ($itemName === null) break;
            if (!empty(trim($itemName))) {
                $quantity = $request->input("qty_se{$i}");
                $amount = $request->input("amount_se{$i}");
                $cleanAmount = $amount ? (float) str_replace(',', '', $amount) : 0;
                $cleanQuantity = $quantity ? (int) $quantity : 0;

                $items[] = [
                    'item_name' => trim($itemName),
                    'quantity' => $cleanQuantity,
                    'amount' => $cleanAmount,
                ];
            }
        }

        // Save new items
        foreach ($items as $i => $item) {
            InwardItem::create([
                'inward_id' => $inward->id,
                'sr_no' => $i + 1,
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
                'amount' => $item['amount'],
            ]);
        }

        return redirect()->route('inward.inward_view_All')->with('success', 'Inward Updated Successfully!');
    }
}