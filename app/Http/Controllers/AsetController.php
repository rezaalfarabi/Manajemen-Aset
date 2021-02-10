<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class AsetController extends Controller
{
    public function __construct()
    {
        $this->rule = array(
            'nama_aset' => 'required', 
            'kategori_id' => 'required',
            'nup' => 'required',
            'qty' => 'required',
            'satuan_id' => 'required',
            'departement_id' => 'required'
        );
    }

    public function datatable()
    {
        $data['aset'] = DB::table('tb_aset')
                        ->join('tb_kategori', 'tb_kategori.kategori_id', 'tb_aset.kategori_id')
                        ->join('tb_satuan', 'tb_satuan.satuan_id', 'tb_aset.satuan_id')
                        ->join('tb_departement', 'tb_departement.departement_id', 'tb_aset.departement_id')
                        ->get();
                        // dd($data['aset']);
        return view('backend.page.dataaset.datatable',$data);
    }

    public function index() 
    {
        $data['kategori'] = DB::table('tb_kategori')->get();
        $data['departement'] = DB::table('tb_departement')->get();
        $data['satuan'] = DB::table('tb_satuan')->get();
        // dd($data['kategori']);
        return view('backend.page.dataaset.index', $data);
    }

    public function save(Request $r) 
    {
        $id = $r->id_aset;
        if($id == '') 
        {
            $validator = Validator::make($r->all(), $this->rule);
            if($validator->fails())
            {
                return redirect('data-aset')
                        ->withErrors($validator)
                        ->withInput();
            } else {
                $simpan = DB::table('tb_aset')->insert([
                    'nama_aset' => $r->nama_aset, 
                    'serial_number' => $r->serial_number,
                    'nup' => $r->nup,
                    'kategori_id' => $r->kategori_id,
                    'tahun_pengadaan' => $r->tahun_pengadaan,
                    'qty' => $r->qty,
                    'satuan_id' => $r->satuan_id,
                    'nama_pegawai' => $r->nama_pegawai,
                    'departement_id' => $r->departement_id,
                    'status' => 1
                ]);
    
                if($simpan == true) 
                {
                    $message = array('message' => 'Success!', 'title' => 'Data Aset berhasil ditambahkan');
                    return response()->json($message);
                }
            }
        } else {
            $validator = Validator::make($r->all(), $this->rule);
            if($validator->fails())
            {
                return redirect('data-aset')
                        ->withErrors($validator)
                        ->withInput();
            }else{
                $update = DB::table('tb_aset')->where('id_aset', $id)->update([
                    'nama_aset' => $r->nama_aset, 
                    'serial_number' => $r->serial_number,
                    'nup' => $r->nup,
                    'kategori_id' => $r->kategori_id,
                    'tahun_pengadaan' => $r->tahun_pengadaan,
                    'qty' => $r->qty,
                    'satuan_id' => $r->satuan_id,
                    'nama_pegawai' => $r->nama_pegawai,
                    'departement_id' => $r->departement_id,
                ]);
    
                if($update == true) 
                {
                    $message = array('message' => 'Success!', 'title' => 'Data Aset berhasil diubah');
                    return response()->json($message);
                }
            }
        }
    }

    public function status(Request $r) 
    {
        $id_aset = $r->id_aset;
        $status = $r->status;

        $update = DB::table('tb_aset')->where('id_aset', $id_aset)->update(['status' => $status]);
        if($update == true) 
            {
                $message = array('message' => 'Success!', 'title' => 'Status berhasil diubah');
                return response()->json($message);
            }
    }

    public function hapus(Request $r)
    {
        $id_aset = $r->id_aset;

        $hapus = DB::table('tb_aset')->where('id_aset', $id_aset)->delete();

        if($hapus == true) 
        { 
            $message = array('message' => 'Success!', 'title' => 'Data berhasil dihapus');
            return response()->json($message);
        }
    }
}
