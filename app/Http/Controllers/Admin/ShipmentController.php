<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Sage300Service;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    protected $sage300;

    public function __construct(Sage300Service $sage300)
    {
        $this->sage300 = $sage300;
    }

    public function index()
    {
        $response = $this->sage300->getICShipments();

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Failed to fetch data'], 500);
    }

    public function show_data_seq(Request $request)
    {
        $id = $request->cmbSelectVal;
        $response = $this->sage300->getShipmentById($id);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Failed to fetch data'], 500);
    }

    public function getShipmentsData()
    {
        $response = $this->sage300->getICShipments();

        if ($response->successful()) {
            return $response->json(); // Return the array directly
        }

        return ['value' => []]; // Return empty array on error
    }
}
