<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "nama" => "superadmin",
                "email" => "admin@admin.com",
                "level" => 1,
                "username" => "admin", 
                "password" => password_hash("admin",PASSWORD_DEFAULT),
                "ulangi_password" => "admin"
            ]
        ];
        DB::table('tb_pegawai')->insert($data);
    }
}
