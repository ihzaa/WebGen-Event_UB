<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\categori;
use App\Models\event;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $event = event::find($request->id);
        Storage::delete('public/events_poster/' . $event->poster);
        $event->delete();
        return $this->getAllEventWithCategoryName();
    }

    public function tambahGet()
    {
        $data = array();
        $data['cat'] = categori::pluck('name', 'id');
        return view('admin.tambah_event', compact('data'));
    }


    public function tambahPost(Request $request)
    {
        $messages = [
            'title.required' => 'Nama Event Harus Diisi!',
            'desc.required' => 'Deskripsi Event Harus Diisi!',
        ];
        $validatedData = $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'poster' => 'required|image|max:256',
            'date' => 'required',
            'kategori' => 'required'
        ], $messages);

        $event = new event();
        $event->title = $request->title;
        $event->desc = $request->desc;
        $event->poster = "abc";
        $event->date = Carbon::parse($request->date);
        $event->categori_id = $request->kategori;
        $event->save();

        $posterpath = $request->file('poster')->storeAs('public/events_poster', $event->id . '.' . $request->file('poster')->extension());
        $event->poster = $event->id . '.' . $request->file('poster')->extension();
        $event->save();

        return redirect(route('admin_kelola_event_index'))->with('icon', 'success')->with('title', 'Berhasil!')->with('message', 'Berhasil menambahkan event.');
    }

    public function editGet($id)
    {
        $data = array();
        $data['event'] = event::find($id);
        $data['cat'] = categori::pluck('name', 'id');
        return view('admin.edit_event', compact('data'));
    }

    public function editPost($id, Request $request)
    {
        $messages = [
            'title.required' => 'Nama Event Harus Diisi!',
            'desc.required' => 'Deskripsi Event Harus Diisi!',
        ];
        $validatedData = $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'poster' => 'image|max:256',
            'date' => 'required',
            'kategori' => 'required'
        ], $messages);

        $fotoAdaKah = $request->has('poster') ? true : false;
        $event = event::find($id);
        if ($fotoAdaKah) {
            Storage::delete('public/events_poster/' . $event->poster);
            $posterpath = $request->file('poster')->storeAs('public/events_poster', $id . '.' . $request->file('poster')->extension());
            $event->poster = $id . '.' . $request->file('poster')->extension();
        }
        $event->title = $request->title;
        $event->desc = $request->desc;
        $event->date = Carbon::parse($request->date);
        $event->categori_id = $request->kategori;
        $event->save();
        return redirect(route('admin_kelola_event_index'))->with('icon', 'success')->with('title', 'Berhasil!')->with('message', 'Berhasil mengubah event.');
    }
}
