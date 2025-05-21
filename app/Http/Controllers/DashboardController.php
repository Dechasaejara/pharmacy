<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {

        $data = User::all();
        return view('dashboard.dashboard');
    }
    
}
