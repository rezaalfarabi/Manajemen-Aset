<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DepartementController extends Controller
{
    public function datatable() 
    {
        $data['departement'] = DB::table('tb_departement')->get();
        return view('backend.page.departement.dataDepartement', $data);
    }

    public function index() 
    {
        $data['departement'] = DB::table('tb_departement')->get();
        return view('backend.page.departement.index', $data);
    }

    public function save(Request $r) 
    {
        $id = $r->departement_id;
        if($id == '') 
        {
            $save = DB::table('tb_departement')->insert(['departement_nama' => $r->departement_nama]); 
            $message = array('message' => 'Success!', 'title' => 'Lokasi berhasil ditambahkan');
                return response()->json($message);
            // if($save == true) {
            //     echo json_encode(['status' => 200]);
            // } else {
            //     echo json_encode(['status' => 400]);
            // }
            // return back()->with('pesan', 'Data Berhasil Disimpan');
        } else {
            $update = DB::table('tb_departement')->where('departement_id', $id)->update(['departement_nama' =>$r->departement_nama]);
            $message = array('message' => 'Success!', 'title' => 'Lokasi berhasil diubah');
                return response()->json($message);
            // if($update == true) {
            //     echo json_encode(['status' => 200]);
            // } else {
            //     echo json_encode(['status' => 400]);
            // }
            // return back()->with('pesan', 'Data Berhasil Diubah');
        }
    }

    public function hapus(Request $r)
    {
        $departement_id = $r->departement_id;

        $hapus = DB::table('tb_departement')->where('departement_id', $departement_id)->delete();

        if($hapus == true) 
        { 
            $message = array('message' => 'Success!', 'title' => 'Data berhasil dihapus');
            return response()->json($message);
        }
    }

    // public function hapus($departement_id)
    // {
    //     $delete = DB::table('tb_departement')->where('departement_id', $departement_id)->delete();
    //     // check data deleted or not
    //     if ($delete !== null) {
    //         $success = true;
    //         $message = "Data berhasil dihapus";
            
    //     } else {
    //         $success = true;
    //         $message = "Data tidak ditemukan";
    //     }

    //     //  Return response
    //     return response()->json([
    //         'success' => $success,
    //         'message' => $message,
    //     ]); 
    // }
    
}
