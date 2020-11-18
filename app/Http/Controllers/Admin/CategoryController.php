<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\categori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function getAllVategoryWithCountEvent()
    {
        // return categori::withCount('event')->get();
        return DB::select(DB::raw('select `categoris`.`id`,`categoris`.`name`, (select count(*) from `events` where `categoris`.`id` = `events`.`categori_id`) as `event_count` from `categoris`'));
    }

    public function insert(Request $request)
    {

        $isExist =  categori::where('name', $request->name)->first();
        if ($isExist == "") {
            categori::create([
                "name" => $request->name
            ]);
            return response()->json($this->getAllVategoryWithCountEvent(), 200);
        } else {
            return response()->json([], 222);
        }
    }

    public function edit($id, Request $request)
    {
        $isExist =  categori::where('name', $request->name)->first();
        if ($isExist == "") {
            categori::find($id)->update(["name" => $request->name]);
            return response()->json($this->getAllVategoryWithCountEvent());
        } else {
            return response()->json([], 222);
        }
    }

    public function delete(Request $request)
    {
        $count = categori::whereId($request->id)->withCount('event')->first();
        if ($count->event_count == 0) {
            categori::find($request->id)->delete();
            return response()->json($this->getAllVategoryWithCountEvent());
        } else {
            return response()->json([], 234);
        }
    }
}
