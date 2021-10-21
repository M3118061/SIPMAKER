<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Prayoga',
                'jk' => 'Laki-Laki',
                'alamat' => 'Bogor',
                'no_telp' => '089867821111',
                'email' => 'prayoga5070@gmail.com',
                // 'is_admin' => 1,
                'password' => bcrypt('rahasia'),
                'role' => 'Manajer',
                'exp_reminder' => '3',
                'status' => '1',
            ],
            [
                'name' => 'Muthia',
                'jk' => 'Perempuan',
                'alamat' => 'Bantul',
                'no_telp' => '089867823331',
                'email' => 'amesthimuthia@gmail.com',
                // 'is_admin' => 1,
                'password' => bcrypt('kireina1818'),
                'role' => 'Admin',
                'exp_reminder' => '3',
                'status' => '1',
            ],
            [
                'name' => 'Kireina',
                'jk' => 'Perempuan',
                'alamat' => 'Yogyakarta',
                'no_telp' => '082766627741',
                'email' => 'pegawai@kireinahana',
                // 'is_admin' => 0,
                'password' => bcrypt('hana'),
                'role' => 'Pegawai',
                'exp_reminder' => '3',
                'status' => '1',
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
