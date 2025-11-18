<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
     public function permissions(Request $request)
    {
        // $searchKey = $request->searchKey;
        // $getuserlevels = Userlevel::where('level_name', 'like', '%' . $searchKey . '%')
        //     ->orderBy('created_at', 'DESC')
        //     ->paginate(env("RECORDS_PER_PAGE"));

        // return view('masterfiles.userlevels', compact(['getuserlevels', 'searchKey']));
    }
}
