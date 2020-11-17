<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = ad::all();
        // dd($data);
        return view('admin/Advertisement/kelolaAdvertisement', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = ad::all();
        return (view('Admin/Advertisement/Tambah', compact('data')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'image' => 'required|image|mimes:jpeg,svg,jfif,png,jpg|max:256',
            'desc' => 'required'
        ]);
        $data = new ad();
        $data->image = $request->image;
        $data->desc = $request->desc;
        $data->save();
        //gambar akan di simpan di public/assets
        // //gambar akan di simpan di public/assets
        $extension = $request->file('image')->getClientOriginalExtension();
        $location = 'images/advertisement';
        $nameUpload = $data->id . 'thumbnail.' . $extension;
        $request->file('image')->move('assets/' . $location, $nameUpload);
        $filepath = 'assets/' . $location . '/' . $nameUpload;
        $data->image = $filepath;
        $data->save();

        return redirect(route('admin_advertisement_index'))->with('sukses_tambah', 'Greate! Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(ad $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(ad $advertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ad $advertisement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(ad $advertisement)
    {
        //
    }
}
