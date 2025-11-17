<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userlevel;
use Illuminate\Support\Facades\Auth;

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
}
