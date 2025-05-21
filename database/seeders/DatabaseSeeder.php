<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Matkul;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nim' => '2311501304',
            'name' => 'Muhammad Rifky Ramadhani',
            'email' => "rifkydoang2014@gmail.com",
            'password' => Hash::make("2311501304"),
        ]);

        Matkul::create(
            [
                'kode_mata_kuliah' => "KP001",
                'nama_mata_kuliah' => "Mobile Programming",
                "sks" => 3,
            ],


        );

        // Dosen::factory(25)->create();
        // Dosen::create([
        //     'nip' => "2311501304",
        //     'nama' => 'Aris Setiabudi',
        //     'email' => 'arissetiabudi@gmail.com',
        //     'to_tele'
        // ])
    }
}
