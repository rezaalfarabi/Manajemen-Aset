<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PegawaiModel;

class PegawaiController extends Controller
{
    public function index()
    {
        // aksi ambil semua data
        // eloquent
        // $data = PegawaiModel::all();
        $data = DB::table('tb_pegawai')->get();
        //  dd($data);
        return view('backend.page.pegawai.index',compact('data'));
        
    }

    public function add(Request $r) {
        $id = $r->id_pegawai;
        if($id == '')
        {
            if($r->password == $r->ulangi_password)
            {
                $pass = password_hash($r->password,PASSWORD_DEFAULT);

                // input builder
                DB::table('tb_pegawai')->insert([
                    'nama' => $r->nama,
                    'email' => $r->email,
                    'level' => $r->level,
                    'username' => $r->username,
                    'password' => $pass,
                    'ulangi_password' => $r->password

                ]);

                return back()->with('pesan', 'Data Berhasil Disimpan');
            } else {
                return back()->with('pesan', 'Data Gagal Disimpan');
            }    

        } else {
            // cara penggunaan eloquent 

            // cek apakah ada perubahan password..jika tidak simpan tanpa edit password
            if($r->password == '') 
            {

                // update query builder
                DB::table('tb_pegawai')->where('id_pegawai', $id)->update([
                    'nama' => $r->nama,
                    'email' => $r->email,
                    'level' => $r->level,
                    'username' => $r->username
                ]);
                // jika user edit password baru maka simpan dengan password baru
            } else {
                // pengecekan password sama atau tidak dari inputan
                if($r->password == $r->ulangi_password) 
                {
                    $pass = password_hash($r->password,PASSWORD_DEFAULT);

                     // update query builder
                DB::table('tb_pegawai')->where('id_pegawai', $id)->update([
                    'nama' => $r->nama,
                    'email' => $r->email,
                    'level' => $r->level,
                    'username' => $r->username,
                    'password' => $pass,
                    'ulangi_password' => $r->password,
                ]);
                }
            }
            return back()->with('pesan', 'Data Berhasil Diubah');
        }
    }

    public function delete($id_pegawai) 
    {
        $id = decrypt($id_pegawai);
        // dd($id);
        $delete = DB::table('tb_pegawai')->where('id_pegawai', $id)->delete();
        if($delete == true) 
        {
            return back()->with('pesan', 'Data Berhasil Dihapus');
        } else 
        {
            return back()->with('pesan', 'Data Gagal Dihapus');
        }
    }
}
