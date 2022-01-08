<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Katalog;
use App\Models\Peminjaman;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        Anggota::factory(10)->create();
        User::create([
            'name' => 'sandrian',
            'email' => 'sandrian@gmail.com',
            'password' => bcrypt('password')
        ]);

        Katalog::create([
            'name' => 'Katalog A'
        ]);

        Katalog::create([
            'name' => 'Katalog B'
        ]);

        Katalog::create([
            'name' => 'Katalog C'
        ]);

        Katalog::create([
            'name' => 'Katalog D'
        ]);

        Katalog::create([
            'name' => 'Katalog E'
        ]);

        Penerbit::create([
            'nama_penerbit' => 'Kampungku',
            'email' => 'kampungku@gmail.com',
            'telp' => '001',
            'alamat' => 'abxscreet.street',
        ]);

        Penerbit::create([
            'nama_penerbit' => 'Republika.',
            'email' => 'republika@gmail.com',
            'telp' => '002',
            'alamat' => 'republika.street',
        ]);

        Penerbit::create([
            'nama_penerbit' => 'Pastel Books',
            'email' => 'pastelbook@gmail.com',
            'telp' => '003',
            'alamat' => 'pastel.street',
        ]);

        Penerbit::create([
            'nama_penerbit' => 'Gagas Media',
            'email' => 'gagasmedia@gmail.com',
            'telp' => '004',
            'alamat' => 'gagasmedia.street',
        ]);

        Penerbit::create([
            'nama_penerbit' => 'Gradien Media Tama',
            'email' => 'gradien@gmail.com',
            'telp' => '005',
            'alamat' => 'pastel.street',
        ]);

        Penerbit::create([
            'nama_penerbit' => 'Bentang Pustaka',
            'email' => 'bentang@gmail.com',
            'telp' => '006',
            'alamat' => 'bentang.street',
        ]);

        Pengarang::create([
            'nama_pengarang' => 'Pengarang 1.',
            'email' => 'pengarang1@gmail.com',
            'telp' => '002',
            'alamat' => 'republika.street',
        ]);

        Pengarang::create([
            'nama_pengarang' => 'Pengarang 2.',
            'email' => 'pengarang1@gmail.com',
            'telp' => '002',
            'alamat' => 'republika.street',
        ]);

        Pengarang::create([
            'nama_pengarang' => 'Pengarang 3.',
            'email' => 'pengarang3@gmail.com',
            'telp' => '002',
            'alamat' => 'republika.street',
        ]);

        Pengarang::create([
            'nama_pengarang' => 'pengarang 4.',
            'email' => 'pengarang4@gmail.com',
            'telp' => '002',
            'alamat' => 'republika.street',
        ]);

        Buku::factory(20)->create();


    }
}
