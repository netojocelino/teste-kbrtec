<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AthleteDashboardController extends Controller
{

    public function login ()
    {
        return view('athletes.admin.login');
    }
}
