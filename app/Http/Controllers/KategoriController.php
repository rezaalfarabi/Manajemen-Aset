<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KategoriController extends Controller
{
    public function index() 
    {
        $data['kategori'] = DB::table('tb_kategori')->get();
        return view('backend.page.kategori.index', $data);
    }

    public function save(Request $r) 
    {
        $id = $r->kategori_id;
        if($id == '') 
        {
            $save = DB::table('tb_kategori')->insert(['kategori_nama' => $r->kategori_nama]);
            return back()->with('pesan', 'Data Berhasil Disimpan');
        } else {
            $update = DB::table('tb_kategori')->where('kategori_id', $id)->update(['kategori_nama' =>$r->kategori_nama]);
            return back()->with('pesan', 'Data Berhasil Diubah');
        }
    } 

    public function delete($kategori_id) 
    {
        $id = decrypt($kategori_id);
        // dd($id);

        $delete = DB::table('tb_kategori')->where('kategori_id', $id)->delete();

        if($delete == true) 
        {
            return back()->with('pesan', 'Data Berhasil Dihapus');
        } else {
            return back()->with('pesan', 'Data Gagal Dihapus');
        }
    }
}
