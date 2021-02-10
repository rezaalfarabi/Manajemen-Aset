<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TypepermohonanController extends Controller
{
    public function datatable() 
    {
        $data['type_permohonan'] = DB::table('tb_type_permohonan')->get();
        return view('backend.page.typepermohonan.datatable', $data);
    }

    public function index() 
    {
        return view('backend.page.typepermohonan.index');
    }

    public function save(Request $r) 
    {
        $id = $r->id_type_permohonan;
        if($id == '') 
        {
            $simpan = DB::table('tb_type_permohonan')->insert(['permohonan' => $r->permohonan]);
            if($simpan == true) {
                $message = array('message' => 'Success!', 'title' => 'Data berhasil ditambahkan');
                return response()->json($message);
            } 
            // return back()->with('pesan', 'Data Berhasil Disimpan');
        } else {
            $update = DB::table('tb_type_permohonan')->where('id_type_permohonan', $id)->update(['permohonan' =>$r->permohonan]);
            if($update == true) {
                $message = array('message' => 'Success!', 'title' => 'Data berhasil diubah');
                return response()->json($message);
            } 
            // return back()->with('pesan', 'Data Berhasil Diubah');
        }
    } 

    public function hapus($id)
    {
        $delete = DB::table('tb_type_permohonan')->where('id_type_permohonan', $id)->delete();
        // check data deleted or not
        if ($delete !== null) {
            $success = true;
            $message = "Data berhasil dihapus";
            
        } else {
            $success = true;
            $message = "Data tidak ditemukan";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]); 
    }
}
