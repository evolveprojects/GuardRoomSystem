<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\Permission_type;
use App\Models\User;
use App\Models\ErrorLogger;
use Illuminate\Validation\Rule;


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
            ->orderBy('permissions.permission_type', 'ASC')
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

        // $hasPermission = (Auth::user()->hasPermission("edit permission") || Auth::user()->id == '1');

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

        // Pass all permission types for edit dropdown
        $permission_type = Permission_type::all();

        return view('permission.permission_type', compact(['permission', 'searchKey', 'permission_type']));
    }


    public function addpermission_type(Request $request)
    {

        $hasPermission = (Auth::user()->hasPermission("Add Permission Type")|| Auth::user()->id == '1');

        if ($hasPermission) {

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
        } else {
            return redirect("/not_allowed");
        }
    }

 

    public function updatepermission_type(Request $request)
    {
        // Check Permission
        $hasPermission = (Auth::user()->hasPermission("Edit Permission Type") || Auth::user()->id == 1);

        if ($hasPermission) {

            // Get the record using request id
            $permission = Permission_type::findOrFail($request->id);

            // Validate input
            $validated = $request->validate([
                'type_name' => [
                    'required',
                    'string',
                    Rule::unique('permission_types', 'type_name')->ignore($permission->id),
                ],
                'status' => ['required'],
            ]);

            // Update record
            $permission->type_name = $request->type_name;
            $permission->status = $request->status;
            $permission->updated_by = Auth::id();
            $permission->save();

            return back()->with('success', 'Permission Type updated successfully!');
        } else {
            return redirect("/not_allowed");
        }
    }



    public function updateUserPermissions(Request $request){



        // $hasPermission = Auth::user()->hasPermission('add_permissions');



        // if($hasPermission){



            try{

                $permissions = $request->permissions;
                $user = User::find($request->user_id);

                if($user != null){
                    $user->permissions()->detach();
                    $user->permissions()->attach($permissions);
                    return back()->with('success','User permissions updated successfully !');
                }else{

                    return back()->with('error','Could not find the user !');
                }
            }catch(\Exception $exception){
                ErrorLogger::logAdminError($exception);
                return back()->with('error','Error occured - '.$exception->getMessage().' - line - '.$exception->getLine());
            }
    //     }else{
    //         return redirect('admin/not_allowed');
    //    }
    }
}
