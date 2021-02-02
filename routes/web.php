<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if(session('id') != '')
    {
        return view('backend.home');
    }else{
        return redirect('login');
    }
    });

// Route::middleware(['belum_login'])->group(function() {
// });

Route::get('/login', 'LoginController@index')->name('login')->middleware('belum_login');
Route::post('/aksilogin', 'LoginController@login')->name('aksilogin')->middleware('belum_login');

// middleware sudah login
Route::middleware(['sudah_login'])->group(function() {
    // Route::get('/', function () {
    //     return view('backend.home');
    // });
    Route::get('/pegawai', 'PegawaiController@index')->name('pegawai');
    Route::post('/add-pegawai', 'PegawaiController@add')->name('add-pegawai');
    Route::get('/delete-pegawai/{id_pegawai}', 'PegawaiController@delete')->name('delete-pegawai');
    Route::get('/logout', 'LoginController@logout')->name('logout');


    // kategori
    Route::get('/kategori', 'KategoriController@index')->name('kategori');
    Route::post('/kategori-add', 'KategoriController@save')->name('kategori-add');
    Route::get('/delete-kategori/{kategori_id}', 'KategoriController@delete')->name('delete-kategori');

    // Departement
    Route::get('/departement', 'DepartementController@index')->name('departement');
    Route::post('/departement-add', 'DepartementController@save')->name('departement-add');
    Route::get('/delete-departement/{departement_id}', 'DepartementController@delete')->name('delete-departement');

    // Satuan Unit
    Route::get('/satuan', 'SatuanController@index')->name('satuan');
    Route::post('/satuan-add', 'SatuanController@save')->name('satuan-add');
    Route::get('/delete-satuan/{satuan_id}', 'SatuanController@delete')->name('delete-satuan');

});


