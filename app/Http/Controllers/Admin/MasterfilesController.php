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

public function drivers()
{
    return view('masterfiles.drivers');
}

public function helpers()
{
    return view('masterfiles.helpers');
} 

public function securities()
{
    return view('masterfiles.securities');
}

}
