<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// masterfiles
Route::get('/userlevel', [App\Http\Controllers\Admin\MasterfilesController::class, 'userlevel'])->name('Masterfile.userlevel');
Route::get('/users', [App\Http\Controllers\Admin\MasterfilesController::class, 'users'])->name('Masterfile.users');
Route::get('/centers', [App\Http\Controllers\Admin\MasterfilesController::class, 'centers'])->name('Masterfile.centers');
Route::get('/vehicles', [App\Http\Controllers\Admin\MasterfilesController::class, 'vehicles'])->name('Masterfile.vehicles');
Route::get('/drivers', [App\Http\Controllers\Admin\MasterfilesController::class, 'drivers'])->name('Masterfile.drivers');
Route::get('/helpers', [App\Http\Controllers\Admin\MasterfilesController::class, 'helpers'])->name('Masterfile.helpers');
Route::get('/securities', [App\Http\Controllers\Admin\MasterfilesController::class, 'securities'])->name('Masterfile.securities');
Route::post('/createuserlevel', [App\Http\Controllers\Admin\MasterfilesController::class, 'adduserlevel'])->name('Masterfile.adduserlevel');
Route::post('/updateuserlevel', [App\Http\Controllers\Admin\MasterfilesController::class, 'updateuserlevel'])->name('Masterfile.updateuserlevel');
Route::post('/create-center', [App\Http\Controllers\Admin\MasterfilesController::class, 'addCenter'])->name('Masterfile.addcenter');
Route::post('/update-center', [App\Http\Controllers\Admin\MasterfilesController::class, 'updateCenter'])->name('Masterfile.updatecenter');
Route::post('/create-vehicle', [App\Http\Controllers\Admin\MasterfilesController::class, 'addVehicle'])->name('Masterfile.addvehicle');
Route::post('/update-vehicle', [App\Http\Controllers\Admin\MasterfilesController::class, 'updateVehicle'])->name('Masterfile.updatevehicle');
Route::post('/create-driver', [App\Http\Controllers\Admin\MasterfilesController::class, 'addDriver'])->name('Masterfile.adddriver');
Route::post('/update-driver', [App\Http\Controllers\Admin\MasterfilesController::class, 'updateDriver'])->name('Masterfile.updatedriver');
Route::get('/incentive', [App\Http\Controllers\Admin\MasterfilesController::class, 'incentive'])->name('Masterfile.incentive');

//permission routes
Route::get('/permission', [App\Http\Controllers\Admin\PermissionController::class, 'permissions'])->name('permissions.view');
Route::post('/createpermission', [App\Http\Controllers\Admin\PermissionController::class, 'addpermission'])->name('permissions.addpermission');
Route::post('/updatepermission', [App\Http\Controllers\Admin\PermissionController::class, 'updatepermission'])->name('permissions.updatepermission');
Route::get('/permission_type', [App\Http\Controllers\Admin\PermissionController::class, 'permissions_type'])->name('permissions.type');
Route::post('/createpermission_type', [App\Http\Controllers\Admin\PermissionController::class, 'addpermission_type'])->name('permissions.addpermission_type');
Route::post('/updatepermission_type', [App\Http\Controllers\Admin\PermissionController::class, 'updatepermission_type'])->name('permissions.updatepermission_type');
Route::post('/permissions_change', [App\Http\Controllers\Admin\PermissionController::class, 'updateUserPermissions'])->name('permissions.edit');


//not allowed route
 Route::get('/not_allowed', function () {
        return view('errors.not_allowed');
    });
Route::post('/update-driver', [App\Http\Controllers\Admin\MasterfilesController::class, 'updateDriver'])->name('Masterfile.updateDriver');

Route::post('/create-helper', [App\Http\Controllers\Admin\MasterfilesController::class, 'addHelper'])->name('Masterfile.addhelper');
Route::post('/update-helper', [App\Http\Controllers\Admin\MasterfilesController::class, 'updateHelper'])->name('Masterfile.updateHelper');

Route::post('/create-security', [App\Http\Controllers\Admin\MasterfilesController::class, 'addSecurity'])->name('Masterfile.addSecurity');
Route::post('/update-security', [App\Http\Controllers\Admin\MasterfilesController::class, 'updateSecurity'])->name('Masterfile.updateSecurity');


//outward module
Route::get('/outwardtype1', [App\Http\Controllers\Admin\OutwardController::class, 'outward_view_t1'])->name('outward.outwardtype1');
Route::get('/outwardtype2', [App\Http\Controllers\Admin\OutwardController::class, 'outward_view_t2'])->name('outward.outwardtype2');
Route::post('/saveoutward_type_1', [App\Http\Controllers\Admin\OutwardController::class, 'saveoutward_type_1'])->name('outward.saveoutward_type_1');
Route::get('/outward_view_All', [App\Http\Controllers\Admin\OutwardController::class, 'outward_view_All'])->name('outward.outward_view_All');
Route::post('/vehicledata', [App\Http\Controllers\Admin\OutwardController::class, 'vehicledata'])->name('vehicledata');
Route::post('/outward/type2/store', [App\Http\Controllers\Admin\OutwardController::class, 'outward_type2_store'])->name('outward.type2.store');
Route::get('/edit_type1/{id}', [App\Http\Controllers\Admin\OutwardController::class, 'outward_edit_t1'])->name('outward.outward_edit_type1');
Route::post('/editoutward_type_1', [App\Http\Controllers\Admin\OutwardController::class, 'editoutward_type_1'])->name('outward.editoutward_type_1');



// inward module
Route::get('/inward', [App\Http\Controllers\Admin\InwardController::class, 'inward_view'])->name('inward.view');

//sage300 Api
Route::post('/sage300_aoddata', [App\Http\Controllers\Admin\ShipmentController::class, 'show_data_seq'])->name('sage300_aoddata');
