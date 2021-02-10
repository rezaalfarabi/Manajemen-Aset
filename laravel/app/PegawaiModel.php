<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PegawaiModel extends Model
{
    public $timeststamp = false;
    protected $table = 'tb_pegawai';
    protected $primarykey = 'id_pegawai';
    protected $fillable = [
        'nama', 'email', 'nik', 'username', 'password', 'ulangi_password'
    ];
}
