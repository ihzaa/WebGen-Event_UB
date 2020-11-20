<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\categori;
use App\Models\ad;
use App\Models\event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return response()->json(event::where('date', '>=', Carbon::now())->orderBy('date', 'asc')->get(['id', 'title', 'poster', 'date']));
    }
    public function getEventByCategoryId($id)
    {
        return response()->json(event::where('categori_id', $id)->where('date', '>=', Carbon::now())->orderBy('date', 'asc')->get(['id', 'title', 'poster', 'date']));
    }
    public function getEventById($id)
    {
        return response()->json(DB::select(DB::raw('SELECT `events`.`title`,`events`.`poster`,`events`.`desc`,`events`.`date`, (SELECT `categoris`.`name` FROM `categoris` WHERE `categoris`.`id` = `events`.`categori_id`) as `category` FROM `events` WHERE `events`.`id` = ' . $id))[0]);
    }
    public function advertisement()
    {

        $advertisement = ad::all();
        return view('user.home', compact('advertisement'));
    }
}
