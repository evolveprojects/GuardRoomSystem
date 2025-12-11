<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userlevel;
use App\Models\Outwardmodel_type1_t1;
use DB;

class ReportController extends Controller
{
    //     public function intencive_report(Request $request)
    //     {

    //         $from = $request->from;
    //         $to = $request->to;


    //         $get_outward_data = DB::table('Outwardmodel_type1_t1s')
    //             ->leftJoin('drivers', 'drivers.id', '=', 'Outwardmodel_type1_t1s.driver')
    //             ->leftJoin('helpers', 'helpers.id', '=', 'Outwardmodel_type1_t1s.helper')
    //             ->leftJoin('vehicles', 'vehicles.id', '=', 'Outwardmodel_type1_t1s.vehicle_no')
    //             ->select(
    //                 'Outwardmodel_type1_t1s.*',
    //                 'drivers.name as d_name',
    //                 'drivers.epf_number as d_epf',
    //                 'helpers.name as h_name',
    //                 'helpers.epf_number as h_epf',
    //                 'vehicles.vehicle_no as vehicle_no',
    //                 'vehicles.type as v_type'
    //             )

    //             ->selectRaw('COUNT(*) OVER(PARTITION BY Outwardmodel_type1_t1s.driver, CAST(Outwardmodel_type1_t1s.created_at AS DATE)) as driver_count')

    //             ->selectRaw('COUNT(*) OVER(PARTITION BY Outwardmodel_type1_t1s.helper, CAST(Outwardmodel_type1_t1s.created_at AS DATE)) as helper_count')

    //             ->selectRaw('ROW_NUMBER() OVER(PARTITION BY Outwardmodel_type1_t1s.driver, CAST(Outwardmodel_type1_t1s.created_at AS DATE) ORDER BY Outwardmodel_type1_t1s.created_at) as driver_trip_no')

    //             ->selectRaw('ROW_NUMBER() OVER(PARTITION BY Outwardmodel_type1_t1s.helper, CAST(Outwardmodel_type1_t1s.created_at AS DATE) ORDER BY Outwardmodel_type1_t1s.created_at) as helper_trip_no')
    //             ->where('Outwardmodel_type1_t1s.status', '1')

    //             ->orderByDesc('Outwardmodel_type1_t1s.created_at')
    //             ->paginate(env("RECORDS_PER_PAGE"))
    //             ->withQueryString();

    //         // Get all sub table data for these main records
    //         $mainIds = $get_outward_data->pluck('id')->toArray();

    //         $sub_data = DB::table('Outwardmodel_type1_t2s')
    //             ->whereIn('outward_id', $mainIds)
    //             ->get()
    //             ->groupBy('outward_id');



    //         return view('report.incentive_report', compact('get_outward_data', 'sub_data', 'searchKey'));
    //     }

    public function intencive_report(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $query = DB::table('Outwardmodel_type1_t1s')
            ->leftJoin('drivers', 'drivers.id', '=', 'Outwardmodel_type1_t1s.driver')
            ->leftJoin('helpers', 'helpers.id', '=', 'Outwardmodel_type1_t1s.helper')
            ->leftJoin('vehicles', 'vehicles.id', '=', 'Outwardmodel_type1_t1s.vehicle_no')
            ->select(
                'Outwardmodel_type1_t1s.*',
                'drivers.name as d_name',
                'drivers.epf_number as d_epf',
                'helpers.name as h_name',
                'helpers.epf_number as h_epf',
                'vehicles.vehicle_no as vehicle_no',
                'vehicles.type as v_type'
            )
            ->selectRaw('COUNT(*) OVER(PARTITION BY Outwardmodel_type1_t1s.driver, CAST(Outwardmodel_type1_t1s.created_at AS DATE)) as driver_count')
            ->selectRaw('COUNT(*) OVER(PARTITION BY Outwardmodel_type1_t1s.helper, CAST(Outwardmodel_type1_t1s.created_at AS DATE)) as helper_count')
            ->selectRaw('ROW_NUMBER() OVER(PARTITION BY Outwardmodel_type1_t1s.driver, CAST(Outwardmodel_type1_t1s.created_at AS DATE) ORDER BY Outwardmodel_type1_t1s.created_at) as driver_trip_no')
            ->selectRaw('ROW_NUMBER() OVER(PARTITION BY Outwardmodel_type1_t1s.helper, CAST(Outwardmodel_type1_t1s.created_at AS DATE) ORDER BY Outwardmodel_type1_t1s.created_at) as helper_trip_no')
            ->where('Outwardmodel_type1_t1s.status', '1');

        // Apply date range filter
        if ($from && $to) {
            $query->whereDate('Outwardmodel_type1_t1s.created_at', '>=', $from)
                ->whereDate('Outwardmodel_type1_t1s.created_at', '<=', $to);
        } elseif ($from) {
            $query->whereDate('Outwardmodel_type1_t1s.created_at', '>=', $from);
        } elseif ($to) {
            $query->whereDate('Outwardmodel_type1_t1s.created_at', '<=', $to);
        }

        $get_outward_data = $query->orderByDesc('Outwardmodel_type1_t1s.created_at')
            ->paginate(env("RECORDS_PER_PAGE"))
            ->withQueryString();

        // Get all sub table data for these main records
        $mainIds = $get_outward_data->pluck('id')->toArray();

        $sub_data = DB::table('Outwardmodel_type1_t2s')
            ->whereIn('outward_id', $mainIds)
            ->get()
            ->groupBy('outward_id');

        return view('report.incentive_report', compact('get_outward_data', 'sub_data', 'from', 'to'));
    }


    public function intencive_report_summary(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $query = DB::table('Outwardmodel_type1_t1s')
            ->leftJoin('drivers', 'drivers.id', '=', 'Outwardmodel_type1_t1s.driver')
            ->leftJoin('helpers', 'helpers.id', '=', 'Outwardmodel_type1_t1s.helper')
            ->leftJoin('vehicles', 'vehicles.id', '=', 'Outwardmodel_type1_t1s.vehicle_no')
            ->select(
                'Outwardmodel_type1_t1s.*',
                'drivers.name as d_name',
                'drivers.epf_number as d_epf',
                'helpers.name as h_name',
                'helpers.epf_number as h_epf',
                'vehicles.vehicle_no as vehicle_no',
                'vehicles.type as v_type'
            )
            ->selectRaw('COUNT(*) OVER(PARTITION BY Outwardmodel_type1_t1s.driver, CAST(Outwardmodel_type1_t1s.created_at AS DATE)) as driver_count')
            ->selectRaw('COUNT(*) OVER(PARTITION BY Outwardmodel_type1_t1s.helper, CAST(Outwardmodel_type1_t1s.created_at AS DATE)) as helper_count')
            ->selectRaw('ROW_NUMBER() OVER(PARTITION BY Outwardmodel_type1_t1s.driver, CAST(Outwardmodel_type1_t1s.created_at AS DATE) ORDER BY Outwardmodel_type1_t1s.created_at) as driver_trip_no')
            ->selectRaw('ROW_NUMBER() OVER(PARTITION BY Outwardmodel_type1_t1s.helper, CAST(Outwardmodel_type1_t1s.created_at AS DATE) ORDER BY Outwardmodel_type1_t1s.created_at) as helper_trip_no')
            ->where('Outwardmodel_type1_t1s.status', '1');

        // Apply date range filter
        if ($from && $to) {
            $query->whereDate('Outwardmodel_type1_t1s.created_at', '>=', $from)
                ->whereDate('Outwardmodel_type1_t1s.created_at', '<=', $to);
        } elseif ($from) {
            $query->whereDate('Outwardmodel_type1_t1s.created_at', '>=', $from);
        } elseif ($to) {
            $query->whereDate('Outwardmodel_type1_t1s.created_at', '<=', $to);
        }

        $get_outward_data = $query->orderByDesc('Outwardmodel_type1_t1s.created_at')
            ->paginate(env("RECORDS_PER_PAGE"))
            ->withQueryString();

        // Get all sub table data for these main records
        $mainIds = $get_outward_data->pluck('id')->toArray();

        $sub_data = DB::table('Outwardmodel_type1_t2s')
            ->whereIn('outward_id', $mainIds)
            ->get()
            ->groupBy('outward_id');

        return view('report.incentive_summary', compact('get_outward_data', 'sub_data', 'from', 'to'));
    }


}
