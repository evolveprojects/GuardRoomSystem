<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userlevel;

class ReportController extends Controller
{
     public function intencive_report(Request $request)
    {

        $searchKey = $request->searchKey;
        $getuserlevels = Userlevel::where('level_name', 'like', '%' . $searchKey . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(env("RECORDS_PER_PAGE"));

        return view('report.incentive_report', compact(['getuserlevels', 'searchKey']));
    }
}
