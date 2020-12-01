<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['akun'] = User::all();
        return view('admin.akun.kelola_akun', compact('data'));
        // dd($data['akun'][0]->username);
    }

    public function ubahPass(Request $request)
    {
        $usr = DB::table('users')->where('id', Auth::id())->first();
        if (Hash::check($request->old, $usr->password)) {
            User::whereId(Auth::id())->update([
                'password' => Hash::make($request->new)
            ]);
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function ubahNama(Request $request)
    {
        User::whereId(Auth::id())->update([
            'username' => $request->nama
        ]);
        return response()->json([
            'status' => true
        ]);
    }
}
