<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AsetController extends Controller
{
    public function index() 
    {
        $data['kategori'] = DB::table('tb_kategori')->get();
        $data['departement'] = DB::table('tb_departement')->get();
        $data['satuan'] = DB::table('tb_satuan')->get();
        $data['aset'] = DB::table('tb_aset')
                        ->join('tb_kategori', 'tb_kategori.kategori_id', 'tb_aset.kategori_id')
                        ->join('tb_satuan', 'tb_satuan.satuan_id', 'tb_aset.satuan_id')
                        ->join('tb_departement', 'tb_departement.departement_id', 'tb_aset.departement_id')
                        ->get();
        // dd($data['aset']);
        return view('backend.page.dataaset.index', $data);
    }

    public function save(Request $r) 
    {
        $id = $r->id_aset;
        if($id == '') 
        {
            $simpan = DB::table('tb_aset')->insert([
                'nama_aset' => $r->nama_aset, 
                'serial_number' => $r->serial_number,
                'kategori_id' => $r->kategori_id,
                'tanggal_pembuatan' => $r->tanggal_pembuatan,
                'qty' => $r->qty,
                'satuan_id' => $r->satuan_id,
                'nama_pegawai' => $r->nama_pegawai,
                'departement_id' => $r->departement_id,
                'status' => 0
            ]);

            if($simpan == true) 
            {
                return back()->with('pesan', 'Data Berhasil Disimpan');
            } else {
                return back()->with('pesan', 'Data Gagal Disimpan');
            }
        } else {
            $update = DB::table('tb_aset')->where('id_aset', $id)->update([
                'nama_aset' => $r->nama_aset, 
                'serial_number' => $r->serial_number,
                'kategori_id' => $r->kategori_id,
                'tanggal_pembuatan' => $r->tanggal_pembuatan,
                'qty' => $r->qty,
                'satuan_id' => $r->satuan_id,
                'nama_pegawai' => $r->nama_pegawai,
                'departement_id' => $r->departement_id,
            ]);

            if($update == true) 
            {
                return back()->with('pesan', 'Data Berhasil Diubah');
            } else {
                return back()->with('pesan', 'Data Gagal Diubah');
            }
        }
    }

    public function status($id, $status) 
    {
        $update = DB::table('tb_aset')->where('id_aset', $id)->update(['status' => $status]);
        if($update == true) 
            {
                return back()->with('pesan', 'Status Update');
            } else {
                return back()->with('pesan', 'Error');
            }
    }

    public function hapus($id) 
    {
        $hapus = DB::table('tb_aset')->where('id_aset', $id)->delete();
        if($hapus == true) 
            {
                return back()->with('pesan', 'Data Berhasil Dihapus');
            } else {
                return back()->with('pesan', 'Error');
            }
    }
}
