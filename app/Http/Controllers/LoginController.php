<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    public function index() 
    {
        return view('backend.page.login.index');
    }

    public function login(Request $request) 
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $data = DB::table('admin')->where('username', $username)->first();
        if($data) {
            $cek = \Hash::check($password, $data->password);
            if($cek == true) {
                $request->session()->put("id", $data->id);
                $request->session()->put("username", $data->username);
                $request->session()->put("nama_lengkap", $data->nama_lengkap);
                return redirect('/');
            } else {
                return redirect()->back()->with('error', "Username / Password Salah");
            }
        } else {
            return redirect()->back()->with('error', "Username / Password Salah");
        }
    }

    public function logout(Request $request) 
    {
        $request->session()->forget('id');
        $request->session()->forget('username');
        $request->session()->forget('nama_lengkap');
        return redirect('/');
    }
}
