<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if(session('id') != '')
    {
        return redirect('home');
    }else{
        return redirect('login');
    }
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('sudah_login');
// Route::middleware(['belum_login'])->group(function() {
// });

Route::get('/login', 'LoginController@index')->name('login')->middleware('belum_login');
Route::post('/aksilogin', 'LoginController@login')->name('aksilogin')->middleware('belum_login');

// middleware sudah login
Route::middleware(['sudah_login'])->group(function() {
    Route::get('/pegawai', 'PegawaiController@index')->name('pegawai');
    Route::post('/add-pegawai', 'PegawaiController@add')->name('add-pegawai');
    Route::get('/delete-pegawai/{id_pegawai}', 'PegawaiController@delete')->name('delete-pegawai');
    Route::get('/logout', 'LoginController@logout')->name('logout');

    // kategori
    Route::get('/kategori', 'KategoriController@index')->name('kategori');
    Route::post('/kategori-simpan', 'KategoriController@save')->name('kategori-simpan');
    Route::post('/hapus/{kategori_id}', 'KategoriController@hapus');

    // Departement
    Route::get('/departement', 'DepartementController@index')->name('departement');
    Route::post('/departement-simpan', 'DepartementController@save')->name('departement-simpan');
    Route::post('departement-hapus', 'DepartementController@hapus');

    // Satuan Unit
    Route::get('/satuan', 'SatuanController@index')->name('satuan');
    Route::post('/satuan-simpan', 'SatuanController@save')->name('satuan-simpan');
    Route::post('/satuan-hapus', 'SatuanController@hapus');

    // Data Aset
    Route::get('/data-aset', 'AsetController@index')->name('data-aset');
    Route::post('/data-aset-simpan', 'AsetController@save')->name('data-aset-simpan');
    Route::post('/data-aset-status', 'AsetController@status');
    Route::post('/data-aset-hapus', 'AsetController@hapus');

    // tampil data table
    Route::get('/data-table', 'AsetController@datatable');
    Route::get('/data-kategori', 'KategoriController@datatable');
    Route::get('/data-satuan', 'SatuanController@datatable');
    Route::get('/data-departement', 'DepartementController@datatable');
    Route::get('/data-type-permohonan', 'TypepermohonanController@datatable');
    Route::get('/data-permohonan', 'PermohonanController@datatable');

    // type permohonan
    Route::get('/type-permohonan', 'TypepermohonanController@index')->name('type-permohonan');
    Route::post('/type-permohonan-save', 'TypepermohonanController@save');
    Route::post('/type-permohonan-hapus/{id}', 'TypepermohonanController@hapus');

    // Data permohonan
    Route::get('/permohonan', 'PermohonanController@index')->name('permohonan');
    Route::post('/permohonan-simpan', 'PermohonanController@save');
    Route::post('/permohonan-status', 'PermohonanController@status');
    Route::post('/permohonan-hapus', 'PermohonanController@hapus');
});


