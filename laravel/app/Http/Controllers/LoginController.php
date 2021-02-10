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
        $data = DB::table('tb_pegawai')->where('username', $username)->first();
        if($data->username == $username) {
            if(password_verify($password, $data->password)) {
                $request->session()->put("id", $data->id_pegawai);
                $request->session()->put("username", $data->username);
                $request->session()->put("nama", $data->nama);
                $request->session()->put("level", $data->level);
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
        $request->session()->forget('nama');
        $request->session()->forget('level');
        return redirect('/');
    }
}
