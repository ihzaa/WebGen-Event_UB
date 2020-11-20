<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\categori;
use App\Models\ad;
use App\Models\event;
use Illuminate\Http\Request;

class HomeUserController extends Controller
{
    public function index(Request $request)
    {
        $data = array();
        $data['advertisement'] = ad::all();
        $data['catCurrent'] = $request->has('cat') ? $request->has('cat') : "";
        $data['cat'] = categori::pluck('name', 'id');
        return view('user.home', compact('data'));
    }
    public function getAllEvent()
    {
        return response()->json(event::all());
    }
    public function getEventByCategoryId($id)
    {
        return response()->json(event::where('categori_id', $id)->get());
    }
    public function advertisement()
    {

        $advertisement = ad::all();
        return view('user.home', compact('advertisement'));
    }
}
