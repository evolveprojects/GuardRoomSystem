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
use Illuminate\Support\Facades\Auth;

class OutwardController extends Controller
{
    public function outward_view_t1(Request $request)
    {
        return view('outward.outwardtype1');
    }
}
