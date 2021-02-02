<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DepartementController extends Controller
{
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
            return back()->with('pesan', 'Data Berhasil Disimpan');
        } else {
            $update = DB::table('tb_departement')->where('departement_id', $id)->update(['departement_nama' =>$r->departement_nama]);
            return back()->with('pesan', 'Data Berhasil Diubah');
        }
    }

    public function delete($departement_id) 
    {
        $id = decrypt($departement_id);
        $delete = DB::table('tb_departement')->where('departement_id', $id)->delete();

        if($delete == true) 
        {
            return back()->with('pesan', 'Data Berhasil Dihapus');
        } else {
            return back()->with('pesan', 'Data Gagal Dihapus');
        }
    }
    
}
