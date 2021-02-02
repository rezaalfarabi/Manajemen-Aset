<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SatuanController extends Controller
{
    public function index() 
    {
        $data['satuan'] = DB::table('tb_satuan')->get();
        return view('backend.page.satuan.index', $data);
    }

    public function save(Request $r) 
    {
        $id = $r->satuan_id;
        if($id == '')
        {
            $save = DB::table('tb_satuan')->insert(['satuan_nama' => $r->satuan_nama]);
            return back()->with('pesan', 'Data Berhasil Disimpan');
        } else {
            $update = DB::table('tb_satuan')->where('satuan_id', $id)->update(['satuan_nama' => $r->satuan_nama]);
            return back()->with('pesan', 'Data Berhasil Diubah');
        }
    }

    public function delete($satuan_id)
    {
        $id = decrypt($satuan_id);

        $delete = DB::table('tb_satuan')->where('satuan_id', $id)->delete();

        if($delete == true) 
        {
            return back()->with('pesan', 'Data Berhasil Dihapus');
        } else {
            return back()->with('pesan', 'Data gagal Dihapus');
        }
    }
}
