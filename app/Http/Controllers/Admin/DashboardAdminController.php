<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\event;
use App\Models\categori;
use App\Models\ad;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $data['event'] = event::count();
        $data['category'] = categori::count();
        $data['ad'] = ad::count();
        return view('admin.dashboard', compact('data'));
    }
}
