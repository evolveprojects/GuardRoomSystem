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
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ShipmentController;
use Illuminate\Validation\Rule;
use App\Models\Payment_con;
// use SebastianBergmann\CodeCoverage\Driver\Driver;

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
            ->orderBy('created_at', 'DESC')
            ->paginate(env("RECORDS_PER_PAGE"));

        $permissions = Permission::select(
            'permissions.*',
            'permission_types.type_name'
        )
            ->leftJoin('permission_types', 'permissions.permission_type', '=', 'permission_types.id')
            ->get()
            ->groupBy('permission_type')
            ->toArray();

        return view('masterfiles.users', compact(['user', 'searchKey', 'permissions']));
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
        $searchKey = $request->get('searchKey', '');
        $drivers = Driver::where('name', 'like', "%$searchKey%")
            ->orWhere('epf_number', 'like', "%$searchKey%")
            ->paginate(10);

        return view('masterfiles.drivers', compact('drivers', 'searchKey'));
    }

    public function helpers(Request $request)
    {
        $searchKey = $request->get('searchKey', '');
        $helpers = Helper::where('name', 'like', "%$searchKey%")
            ->orWhere('epf_number', 'like', "%$searchKey%")
            ->paginate(10);

        return view('masterfiles.helpers', compact('helpers', 'searchKey'));
    }

    public function securities(Request $request)
    {
        $searchKey = $request->get('searchKey', '');
        $securities = Security::where('name', 'like', "%$searchKey%")
            ->orWhere('epf_number', 'like', "%$searchKey%")
            ->paginate(10);

        return view('masterfiles.securities', compact('securities', 'searchKey'));
    }



    /* ============================================================
       USERLEVEL MANAGEMENT
       ============================================================ */

    public function adduserlevel(Request $request)
    {

        $hasPermission = (Auth::user()->hasPermission("add userlevel") || Auth::user()->id == '1');

        if ($hasPermission) {

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
        } else {
            return redirect("/not_allowed");
        }
    }

    public function updateuserlevel(Request $request)
    {

        $hasPermission = (Auth::user()->hasPermission("edit userlevel") || Auth::user()->id == '1');

        if ($hasPermission) {

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
        } else {
            return redirect("/not_allowed");
        }
    }


    /* ============================================================
       CENTER MANAGEMENT
       ============================================================ */

    public function addCenter(Request $request)
    {
        $hasPermission = (Auth::user()->hasPermission("add center ") || Auth::user()->id == '1');

        if ($hasPermission) {

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
        } else {
            return redirect("/not_allowed");
        }
    }


    public function updateCenter(Request $request)
    {
        $hasPermission = (Auth::user()->hasPermission("edit center") || Auth::user()->id == 1);

        if (!$hasPermission) {
            return redirect("/not_allowed");
        }

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


    /* ============================================================
       VEHICLE MANAGEMENT
       ============================================================ */
    public function addVehicle(Request $request)
    {
        $hasPermission = (Auth::user()->hasPermission("add vehicle") || Auth::user()->id == '1');

        if ($hasPermission) {

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
        } else {
            return redirect("/not_allowed");
        }
    }

    public function updateVehicle(Request $request)
    {
        $hasPermission = (Auth::user()->hasPermission("edit vehicle") || Auth::user()->id == '1');

        if ($hasPermission) {

            $validated = $request->validate([
                'id' => ['required', 'exists:vehicles,id'],
                'vehicle_no' => ['required', 'string', 'unique:vehicles,vehicle_no,' . $request->id],
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
        } else {
            return redirect("/not_allowed");
        }
    }

    /* ============================================================
       DRIVER MANAGEMENT
       ============================================================ */
    public function addDriver(Request $request)
    {
        $hasPermission = (Auth::user()->hasPermission("add driver") || Auth::user()->id == '1');

        if ($hasPermission) {

            $validated = $request->validate([
                'name' => ['required', 'string'],
                'epf_number' => ['required', 'string', 'unique:drivers,epf_number'],
                'email' => ['nullable', 'email'],
                'phone' => ['nullable', 'string'],
                'image' => ['nullable', 'image', 'max:2048'],
                'status' => ['required', 'in:0,1'],

            ]);

            $driver = new Driver();
            $driver->name = $request->name;
            $driver->epf_number = $request->epf_number;
            $driver->email = $request->email;
            $driver->phone = $request->phone;
            $driver->status = $request->status;


            if ($request->hasFile('image')) {
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('uploads/drivers'), $fileName);
                $driver->image = $fileName;
            }

            $driver->created_by = Auth::id();
            $driver->save();

            return back()->with('success', 'Driver added successfully!');
        } else {
            return redirect("/not_allowed");
        }
    }

    public function updateDriver(Request $request)
    {
        $hasPermission = (Auth::user()->hasPermission("edit driver") || Auth::user()->id == '1');

        if ($hasPermission) {

            $validated = $request->validate([
                'id' => ['required', 'exists:drivers,id'],
                'name' => ['required', 'string'],
                'epf_number' => ['required', 'string', 'unique:drivers,epf_number,' . $request->id],
                'email' => ['nullable', 'email'],
                'phone' => ['nullable', 'string'],
                'image' => ['nullable', 'image', 'max:2048'],
                'status' => ['required', 'in:0,1'],

            ]);

            $driver = Driver::find($request->id);

            if (!$driver) {
                return back()->with('error', 'Driver not found.');
            }

            $driver->name = $request->name;
            $driver->epf_number = $request->epf_number;
            $driver->email = $request->email;
            $driver->phone = $request->phone;
            $driver->status = $request->status;


            if ($request->hasFile('image')) {
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('uploads/drivers'), $fileName);
                $driver->image = $fileName;
            }

            $driver->updated_by = Auth::id();
            $driver->save();

            return back()->with('success', 'Driver updated successfully!');
        } else {
            return redirect("/not_allowed");
        }
    }

    /* ============================================================
       Helper MANAGEMENT
       ============================================================ */
    public function addHelper(Request $request)
    {
        $hasPermission = (Auth::user()->hasPermission("add helper") || Auth::user()->id == '1');

        if ($hasPermission) {

            $validated = $request->validate([
                'name' => ['required', 'string'],
                'epf_number' => ['required', 'string', 'unique:helpers,epf_number'],
                'email' => ['nullable', 'email'],
                'phone' => ['nullable', 'string'],
                'image' => ['nullable', 'image', 'max:2048'],
                'status' => ['required', 'in:0,1'],

            ]);

            $helper = new Helper();
            $helper->name = $request->name;
            $helper->epf_number = $request->epf_number;
            $helper->email = $request->email;
            $helper->phone = $request->phone;
            $helper->status = $request->status;


            if ($request->hasFile('image')) {
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('uploads/helpers'), $fileName);
                $helper->image = $fileName;
            }

            $helper->created_by = Auth::id();
            $helper->save();

            return back()->with('success', 'Helper added successfully!');
        } else {
            return redirect("/not_allowed");
        }
    }

    public function updateHelper(Request $request)
    {
        $hasPermission = (Auth::user()->hasPermission("edit helper") || Auth::user()->id == '1');

        if ($hasPermission) {

            $validated = $request->validate([
                'id' => ['required', 'exists:helpers,id'],
                'name' => ['required', 'string'],
                'epf_number' => ['required', 'string', 'unique:helpers,epf_number,' . $request->id],
                'email' => ['nullable', 'email'],
                'phone' => ['nullable', 'string'],
                'image' => ['nullable', 'image', 'max:2048'],
                'status' => ['required', 'in:0,1'],

            ]);

            $helper = Helper::find($request->id);

            if (!$helper) {
                return back()->with('error', 'Helper not found.');
            }

            $helper->name = $request->name;
            $helper->epf_number = $request->epf_number;
            $helper->email = $request->email;
            $helper->phone = $request->phone;
            $helper->status = $request->status;

            if ($request->hasFile('image')) {
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('uploads/helpers'), $fileName);
                $helper->image = $fileName;
            }

            $helper->updated_by = Auth::id();
            $helper->save();

            return back()->with('success', 'Helper updated successfully!');
        } else {
            return redirect("/not_allowed");
        }
    }

    /* ============================================================
       Security MANAGEMENT
       ============================================================ */
    public function addSecurity(Request $request)
    {
        $hasPermission = (Auth::user()->hasPermission("add security") || Auth::user()->id == '1');

        if ($hasPermission) {

            $validated = $request->validate([
                'name' => ['required', 'string'],
                'epf_number' => ['required', 'string', 'unique:securities,epf_number'],
                'email' => ['nullable', 'email'],
                'phone' => ['nullable', 'string'],
                'image' => ['nullable', 'image', 'max:2048'],
                'status' => ['required', 'in:0,1'],
            ]);

            $security = new Security();
            $security->name = $request->name;
            $security->epf_number = $request->epf_number;
            $security->email = $request->email;
            $security->phone = $request->phone;
            $security->status = $request->status;

            if ($request->hasFile('image')) {
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('uploads/securities'), $fileName);
                $security->image = $fileName;
            }

            $security->created_by = Auth::id();
            $security->save();

            return back()->with('success', 'Security added successfully!');
        } else {
            return redirect("/not_allowed");
        }
    }

    public function updateSecurity(Request $request)
    {
        $hasPermission = (Auth::user()->hasPermission("edit security") || Auth::user()->id == '1');

        if ($hasPermission) {

            $validated = $request->validate([
                'id' => ['required', 'exists:securities,id'],
                'name' => ['required', 'string'],
                'epf_number' => ['required', 'string', 'unique:securities,epf_number,' . $request->id],
                'email' => ['nullable', 'email'],
                'phone' => ['nullable', 'string'],
                'image' => ['nullable', 'image', 'max:2048'],
                'status' => ['required', 'in:0,1'],
            ]);

            $security = Security::find($request->id);

            if (!$security) {
                return back()->with('error', 'Security not found.');
            }

            $security->name = $request->name;
            $security->epf_number = $request->epf_number;
            $security->email = $request->email;
            $security->phone = $request->phone;
            $security->status = $request->status;

            if ($request->hasFile('image')) {
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('uploads/securities'), $fileName);
                $security->image = $fileName;
            }

            $security->updated_by = Auth::id();
            $security->save();

            return back()->with('success', 'Security updated successfully!');
        } else {
            return redirect("/not_allowed");
        }
    }


    public function incentive(Request $request)
    {
        $searchKey = $request->searchKey;
        $payments = Payment_con::orderBy('created_at', 'DESC')

            ->paginate(env("RECORDS_PER_PAGE"));

        return view('masterfiles.incentive', compact(['payments', 'searchKey']));
    }

    public function customers(Request $request, ShipmentController $shipmentController)
    {

        $searchKey = $request->searchKey;
        $customers_local = Customer::where('customers_name', 'like', '%' . $searchKey . '%')
            ->orWhere('type', 'like', '%' . $searchKey . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(env("RECORDS_PER_PAGE"));
        $customers = $shipmentController->getShipmentscustomers();

        return view('masterfiles.customer', compact(['searchKey', 'customers', 'customers_local']));
    }


    public function addcustomers(Request $request)
    {

        // Check permission - note: using == '1' for ID comparison is not secure
        $hasPermission = Auth::user()->hasPermission("add customer") || Auth::user()->id == 1;

        if (!$hasPermission) {
            return redirect("/not_allowed");
        }

        $validated = $request->validate([
            'customer_number' => ['required', 'string', 'unique:customers,customers'], // Table name, then column name
            'customer_name' => ['required', 'string'], // Add this if you're posting customer_name
            'type' => ['required', 'string'], // Added proper validation
            'distance' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:0,1'],
        ]);

        try {
            $customer = new Customer();
            $customer->customers = $request->customer_number;
            $customer->customers_name = $request->customer_name; // Consistent field name
            $customer->type = $request->type;
            $customer->distance = $request->distance;
            $customer->amount = $request->amount;
            $customer->status = $request->status;
            $customer->created_by = Auth::id();
            $customer->save();

            return back()->with('success', 'Customer added successfully!'); // Changed message from "Security" to "Customer"

        } catch (\Exception $e) {

            // Log the error for debugging
            \Log::error('Error adding customer: ' . $e->getMessage());

            return back()->with('error', 'Failed to add customer. Please try again.');
        }
    }

    public function editcustomers(Request $request)
    {

        $hasPermission = (Auth::user()->hasPermission("edit customer") || Auth::user()->id == '1');

        if (!$hasPermission) {
            return redirect("/not_allowed");
        }

        $validated = $request->validate([
            'id' => ['required', 'exists:customers,id'],
            'customer_number' => ['required', 'string', Rule::unique('customers', 'customers')->ignore($request->id)],
            'customer_name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'distance' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:0,1'],

        ]);

        $customer = Customer::find($request->id);

        if (!$customer) {
            return back()->with('error', 'Customer not found.');
        }

        // Update existing customer instead of creating new one
        $customer->customers = $request->customer_number;
        $customer->customers_name = $request->customer_name;
        $customer->type = $request->type;
        $customer->distance = $request->distance;
        $customer->amount = $request->amount ?? 0; // Handle null amount
        $customer->status = $request->status;
        $customer->updated_by = Auth::id();
        $customer->save();

        return back()->with('success', 'Customer updated successfully!');
    }



    public function paycondition(Request $request)
    {

        // Check permission - note: using == '1' for ID comparison is not secure
        $hasPermission = Auth::user()->hasPermission("add payment condition") || Auth::user()->id == 1;

        if (!$hasPermission) {
            return redirect("/not_allowed");
        }

        $validated = $request->validate([

            'trip' => ['required', 'string'],
            'type' => ['required', 'string'],
            'km_min' => ['required', 'string'],
            'km_max' => ['required', 'string'],
            'weight_min' => ['required', 'string'],
            'weight_max' => ['required', 'string'],
            'driver_amount' => ['required',],
            'helper_amount' => ['required',],

        ]);

        $paycon = Payment_con::query();

        // Add conditions only if the request parameters exist and are not empty
        if ($request->has('type') && !empty($request->type)) {
            $paycon->where('type', $request->type);
        }

        if ($request->has('trip') && !empty($request->trip)) {
            $paycon->where('trip', $request->trip);
        }

        if ($request->has('km_min') && !empty($request->km_min)) {
            $paycon->where('km_min',  $request->km_min);
        }

        if ($request->has('km_max') && !empty($request->km_max)) {
            $paycon->where('km_max',  $request->km_max);
        }

        if ($request->has('weight_min') && !empty($request->weight_min)) {
            $paycon->where('weight_min', $request->weight_min);
        }

        if ($request->has('weight_max') && !empty($request->weight_max)) {
            $paycon->where('weight_max', $request->weight_max);
        }

        if ($request->has('driver_amount') && !empty($request->driver_amount)) {
            $paycon->where('driver_amount', $request->driver_amount);
        }

        if ($request->has('helper_amount') && !empty($request->helper_amount)) {
            $paycon->where('helper_amount', $request->helper_amount);
        }

        // Execute the query
        $result = $paycon->first();

        if ($result) {
            return back()->with('error', 'Data Already Inserted.');
        }
        try {
            $payment = new Payment_con();
            $payment->type = $request->type;
            $payment->trip = $request->trip; // Consistent field name
            $payment->km_min = $request->km_min;
            $payment->km_max = $request->km_max;
            $payment->weight_min = $request->weight_min;
            $payment->weight_max = $request->weight_max;
            $payment->driver_amount = $request->driver_amount;
            $payment->helper_amount = $request->helper_amount;
            $payment->created_by = Auth::id();
            $payment->save();

            return back()->with('success', 'Payment Condition added successfully!'); // Changed message from "Security" to "Payment Condition"

        } catch (\Exception $e) {

            // Log the error for debugging
            \Log::error('Error adding Payment Condition: ' . $e->getMessage());

            return back()->with('error', 'Failed to add Payment Condition. Please try again.');
        }
    }

    public function editpaycondition(Request $request)
    {

        $hasPermission = (Auth::user()->hasPermission("edit payment condition") || Auth::user()->id == '1');

        if (!$hasPermission) {
            return redirect("/not_allowed");
        }

        $validated = $request->validate([
            'trip' => ['required', 'string'],
            'type' => ['required', 'string'],
            'km_min' => ['required', 'string'],
            'km_max' => ['required', 'string'],
            'weight_min' => ['required', 'string'],
            'weight_max' => ['required', 'string'],
            'driver_amount' => ['required',],
            'helper_amount' => ['required',],

        ]);

        $payment = Payment_con::find($request->id);

        if (!$payment) {
            return back()->with('error', 'payment Condition not found.');
        }

        // Update existing customer instead of creating new one
        $payment->type = $request->type;
        $payment->trip = $request->trip; // Consistent field name
        $payment->km_min = $request->km_min;
        $payment->km_max = $request->km_max;
        $payment->weight_min = $request->weight_min;
        $payment->weight_max = $request->weight_max;
        $payment->driver_amount = $request->driver_amount;
        $payment->helper_amount = $request->helper_amount;
        $payment->updated_by = Auth::id();
        $payment->save();

        return back()->with('success', 'Payment Condition updated successfully!');
    }
}
