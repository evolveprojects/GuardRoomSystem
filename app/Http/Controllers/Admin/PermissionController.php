<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\Permission_type;

class PermissionController extends Controller
{
    public function permissions(Request $request)
    {
        $searchKey = $request->searchKey;
        $permission = Permission::select(
            'permissions.*',
            'permission_types.type_name'
        )
            ->leftJoin('permission_types', 'permissions.permission_type', '=', 'permission_types.id')
            ->where('permissions.permission_name', 'LIKE', '%' . $searchKey . '%')
            ->orderBy('permissions.created_at', 'DESC')
            ->paginate(env('RECORDS_PER_PAGE'));

        $permission_type = Permission_type::all();
        // return view('masterfiles.userlevels', compact(['getuserlevels', 'searchKey']));
        return view('permission.permission', compact(['permission', 'searchKey', 'permission_type']));
    }



    public function addpermission(Request $request)
    {

        // $hasPermission = Auth::user()->hasPermission("create_vendor");

        // if ($hasPermission) {

        $validated = $request->validate([
            'permission_name' => ['required', 'string', 'unique:permissions,permission_name'],
            'permission_type' => ['required'],
        ]);



        $permission = new Permission();
        $permission->permission_name = $request->permission_name;
        $permission->permission_type = $request->permission_type;
        $permission->created_by = Auth::id();
        $permission->save();



        return back()->with('success', 'Permission added  successfully !');
        // } else {
        //     return redirect("admin/not_allowed");
        // }
    }

    public function updatepermission(Request $request)
    {

        // $hasPermission = Auth::user()->hasPermission("edit_userlevel");

        // if ($hasPermission) {

        $validated = $request->validate([
            'permission_name' => ['required', 'string'],
            'permission_type' => ['required'],
        ]);

        $permission = Permission::where('id', $request->id)->get()->first();

        if ($permission != null) {

            $permission->permission_name = $request->permission_name;
            $permission->permission_type = $request->permission_type;
            $permission->updated_by = Auth::id();
            $permission->save();

            return back()->with('success', 'Permission updated successfully !');
        } else {
            return back()->with("error", "Could not find the Permission");
        }
        // } else {
        //     return redirect("admin/not_allowed");
        // }
    }


    public function permissions_type(Request $request)
    {
        $searchKey = $request->searchKey;
        $permission = Permission_type::where('type_name', 'like', '%' . $searchKey . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(env("RECORDS_PER_PAGE"));

        // return view('masterfiles.userlevels', compact(['getuserlevels', 'searchKey']));
        return view('permission.permission_type', compact(['permission', 'searchKey']));
    }

    public function addpermission_type(Request $request)
    {

        // $hasPermission = Auth::user()->hasPermission("create_vendor");

        // if ($hasPermission) {

        $validated = $request->validate([
            'type_name' => ['required', 'string', 'unique:permissions,permission_name'],
            'status' => ['required'],
        ]);



        $permission = new Permission_type();
        $permission->type_name = $request->type_name;
        $permission->status = $request->status;
        $permission->created_by = Auth::id();
        $permission->save();



        return back()->with('success', 'Permission Type added  successfully !');
        // } else {
        //     return redirect("admin/not_allowed");
        // }
    }
}
