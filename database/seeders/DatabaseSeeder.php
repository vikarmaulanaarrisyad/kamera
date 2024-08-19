<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Yoga Indra',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 2
            ],
            [
                'name' => 'Mufid',
                'email' => 'superadmin1@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 1
            ],
            [
                'name' => 'rizkibowo',
                'email' => 'rizkibowo@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 0
            ]
        ]);

        DB::table('categories')->insert([
            [
                'nama_kategori' => 'Kamera'
            ],
            [
                'nama_kategori' => 'Lensa'
            ],
            [
                'nama_kategori' => 'Lighting'
            ],
            [
                'nama_kategori' => 'Stabilizer'
            ]
        ]);

        DB::table('alats')->insert([
            [
                'nama_alat' => 'Sony a7ii',
                'kategori_id' => '1',
                'harga24' => '200000',
                'harga12' => '175000',
                'harga6' => '125000',
                'gambar' => '1649951685-Sony-A7-Mark-II-Body-Only-a.jpg'
            ],
        ]);
    }
}
