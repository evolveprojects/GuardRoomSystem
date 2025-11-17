<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterfilesController extends Controller
{

 public function userlevel()
    {
       return view('masterfiles.userlevels');
    }

    public function users()
{
    return view('masterfiles.users');
}

public function centers()
{
    return view('masterfiles.centers');
}

public function vehicles()
{
    return view('masterfiles.vehicles');
}

}
