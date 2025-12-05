<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        return view('monitoring'); // buat file resources/views/monitoring.blade.php
    }
}
