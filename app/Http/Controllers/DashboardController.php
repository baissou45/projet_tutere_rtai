<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use App\Models\Tournee;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller {

    function index() {
        return view('dashboard');
    }

}