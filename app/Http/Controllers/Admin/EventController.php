<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.kelolaEvent');
    }

    public function getAllEventWithCategoryName()
    {
        return DB::select(DB::raw('select `events`.`id`,`events`.`title`,`events`.`poster`,`events`.`date`, ( select `categoris`.`name` from `categoris` where `categoris`.`id` = `events`.`categori_id`) as `category_name` from `events`'));
    }

    public function delete(Request $request)
    {
        event::find($request->id)->delete();
        return $this->getAllEventWithCategoryName();
    }
}
