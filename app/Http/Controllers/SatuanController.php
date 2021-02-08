<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SatuanController extends Controller
{ 
    public function datatable() {
        $data['satuan'] = DB::table('tb_satuan')->get();
        return view('backend.page.satuan.dataSatuan', $data);
    }

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
            if($save == true) {
                echo json_encode(['satuan' => 200]);
            } else {
                echo json_encode(['satuan' => 400]);
            }
            // return back()->with('pesan', 'Data Berhasil Disimpan');
        } else {
            $update = DB::table('tb_satuan')->where('satuan_id', $id)->update(['satuan_nama' => $r->satuan_nama]);
            if($update == true) {
                echo json_encode(['satuan' => 200]);
                // return back()->with('pesan', 'Data Berhasil Diubah');
            } else {
                echo json_encode(['satuan' => 400]);
            }
        }
    }

    public function hapus(Request $r)
    {
        $satuan_id = $r->satuan_id;

        $hapus = DB::table('tb_satuan')->where('satuan_id', $satuan_id)->delete();

        if($hapus == true) 
        { 
            if($hapus) {
                echo json_encode(['satuan' => 200]);
            } else {
                echo json_encode(['satuan' => 400]);
            }
        }
    }
}
