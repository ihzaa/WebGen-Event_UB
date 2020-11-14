<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginGet()
    {
        return view('admin.login');
    }

    public function loginPost(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username', $request->username)->first();
        if ($user != []) {
            if (Hash::check($request->password, $user->password)) {
                $remember = $request->has('remember') ? true : false;
                Auth::guard('admin')->loginUsingId($user->id, $remember);
                if (Session::get('url.intended')) {
                    return redirect()->intended();
                } else {
                    return redirect()->route('admin_home');
                }
            } else {
                return back()->with('icon', 'error')->with('title', 'Maaf')->with('text', 'username atau password salah!');
            }
        } else {
            return back()->with('icon', 'error')->with('title', 'Maaf')->with('text', 'username atau password salah!');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin_login_get'));
    }
}
