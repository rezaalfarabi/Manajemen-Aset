<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class PermohonanController extends Controller
{
    public function __construct()
    {
        $this->rule = array(
            'type_permohonan' => 'required',
            'deskripsi' => 'required'
        );
    }

    public function datatable()
    {
        $data['permohonan'] = DB::table('tb_permohonan')
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai', 'tb_permohonan.id_pegawai')
                        ->join('tb_type_permohonan', 'tb_type_permohonan.id_type_permohonan', 'tb_permohonan.id_type_permohonan')
                        ->get();
        return view('backend.page.permohonan.datatable',$data);
    }

    public function index() 
    {
        $data['type_permohonan'] = DB::table('tb_type_permohonan')->get();
      
        return view('backend.page.permohonan.index', $data);
    }

    public function save(Request $r) 
    {
        $id = $r->id_permohonan;
        if($id == '') 
        {
            $validator = Validator::make($r->all(), $this->rule);
            if($validator->fails())
            {
                return response()->json($validator);
            } else {
                $simpan = DB::table('tb_permohonan')->insert([
                    'id_pegawai' => session('id'), 
                    'tgl_permohonan' => date('Y-m-d'),
                    'id_type_permohonan' => $r->type_permohonan,
                    'deskripsi' => $r->deskripsi,
                    'status' => 0
                ]);
    
                if($simpan == true) 
                {
                    $message = array('message' => 'Success!', 'title' => 'Data berhasil ditambahkan');
                    return response()->json($message);
                }
            }
        } else {
            $validator = Validator::make($r->all(), $this->rule);
            if($validator->fails())
            {
                return response()->json($validator);
            }else{
                $update = DB::table('tb_permohonan')->where('id_permohonan', $id)->update([
                    'id_pegawai' => session('id'), 
                    'tgl_permohonan' => date('Y-m-d'),
                    'id_type_permohonan' => $r->type_permohonan,
                    'deskripsi' => $r->deskripsi
                ]);
    
                if($update == true) 
                {
                    $message = array('message' => 'Success!', 'title' => 'Data berhasil diubah');
                    return response()->json($message);
                }
            }
        }
    }

    public function status(Request $r) 
    {
        $id_permohonan = $r->id_permohonan;
        $status = $r->status;

        $update = DB::table('tb_permohonan')->where('id_permohonan', $id_permohonan)->update(['status' => $status]);
        if($update == true) 
            {
                $message = array('message' => 'Success!', 'title' => 'Status berhasil diubah');
                return response()->json($message);
            }
    }

    public function hapus(Request $r)
    {
        $id_permohonan = $r->id_permohonan;

        $hapus = DB::table('tb_permohonan')->where('id_permohonan', $id_permohonan)->delete();

        if($hapus == true) 
        { 
            $message = array('message' => 'Success!', 'title' => 'Data berhasil dihapus');
            return response()->json($message);
        }
    }
}

