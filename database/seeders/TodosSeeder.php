<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('todos')->insert([
            [
                'nama_tugas' => 'Membuat Aplikasi Laravel',
                'deskripsi' => 'Membuat aplikasi Laravel dengan menggunakan Laravel 8',
                'selesai' => false,
                'deadline' => '2024-12-21',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_tugas' => 'Membuat Aplikasi Vue.js',
                'deskripsi' => 'Membuat aplikasi Vue.js dengan menggunakan Vue.js 3',
                'selesai' => false,
                'deadline' => '2024-12-21',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_tugas' => 'Membuat Aplikasi React.js',
                'deskripsi' => 'Membuat aplikasi React.js dengan menggunakan React.js 17',
                'selesai' => false,
                'deadline' => '2024-12-21',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
