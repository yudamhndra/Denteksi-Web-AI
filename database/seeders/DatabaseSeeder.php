<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dokter;
use App\Models\Orangtua;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Sekolah;
use App\Models\Kelas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'     => 'admin@admin.com',
            'password'  =>  bcrypt('admin1234'),
            'role'      => 'admin'
        ]);

        User::create([
            'email'     => 'dokter@dokter.com',
            'password'  =>  bcrypt('dokter1234'),
            'role'      => 'dokter',

        ]);

        User::create([
            'email'     => 'ortu@ortu.com',
            'password'  =>  bcrypt('ortu1234'),
            'role'      => 'orangtua'
        ]);

    User::create([
        'email' => 'dokter3@dokter.com',
        'password' => bcrypt('dokter1234'),
        'role' => 'dokter',
    ])->dokter()->create([
        'nik' => '357809630603002',
        'nama' => 'dokter',
        'jenis_kelamin' => 'perempuan',
        'tempat_lahir' => 'bantul',
        'tanggal_lahir' => '2003-03-01',
        'no_telp' => '089687109506',
        'no_str' => '560987',
    ]);


        $this->call(HariSeeder::class);

        $kecamatan = Kecamatan::create([
            'nama'     => 'Tambun',

        ]);
        $kelurahan = Kelurahan::create([
            'nama'     => 'Mekarsari',
            'id_kecamatan' => 1,

        ]);

        $sekolah = Sekolah::create([
            'id_kelurahan'     => '1',
            'type' => 'Sekolah',
            'nama' => 'SDN Mekarsari 04',
            'alamat' => 'Jalan Tambun Raya 04',


        ]);

        $sekolah = Sekolah::create([
            'id_kelurahan'     => '1',
            'type' => 'Posyandu',
            'nama' => 'Puskesmas Jatibening',
            'alamat' => 'Jalan Jatibening 90',


        ]);





    }
}
