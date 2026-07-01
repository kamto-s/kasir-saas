<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('super-admin.dashboard');
    }
}
