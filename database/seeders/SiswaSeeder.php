<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswas = [
            ['name' => 'Ahmad Fauzi', 'email' => 'ahmad.fauzi@siswa.sch.id', 'kelas' => 'XI PPLG 1'],
            ['name' => 'Bella Safira', 'email' => 'bella.safira@siswa.sch.id', 'kelas' => 'XI PPLG 2'],
            ['name' => 'Cahya Ramadhan', 'email' => 'cahya.ramadhan@siswa.sch.id', 'kelas' => 'XI DKV 1'],
            ['name' => 'Dewi Sartika', 'email' => 'dewi.sartika@siswa.sch.id', 'kelas' => 'XI DKV 2'],
            ['name' => 'Eko Prasetyo', 'email' => 'eko.prasetyo@siswa.sch.id', 'kelas' => 'XII PPLG 1'],
            ['name' => 'Farhan Alamsyah', 'email' => 'farhan.alamsyah@siswa.sch.id', 'kelas' => 'XII PPLG 2'],
            ['name' => 'Gita Gutawa', 'email' => 'gita.gutawa@siswa.sch.id', 'kelas' => 'X TJAT 1'],
            ['name' => 'Hadi Sucipto', 'email' => 'hadi.sucipto@siswa.sch.id', 'kelas' => 'X TJAT 2'],
            ['name' => 'Indah Permatasari', 'email' => 'indah.permata@siswa.sch.id', 'kelas' => 'XI PPLG 1'],
            ['name' => 'Joko Widodo Putra', 'email' => 'joko.widodo@siswa.sch.id', 'kelas' => 'XI PPLG 2'],
            ['name' => 'Kartika Putri', 'email' => 'kartika.putri@siswa.sch.id', 'kelas' => 'XII DKV 1'],
            ['name' => 'Lukman Hakim', 'email' => 'lukman.hakim@siswa.sch.id', 'kelas' => 'XII DKV 2'],
            ['name' => 'Maya Anggraini', 'email' => 'maya.anggraini@siswa.sch.id', 'kelas' => 'X PPLG 1'],
            ['name' => 'Naufal Rizky', 'email' => 'naufal.rizky@siswa.sch.id', 'kelas' => 'X PPLG 2'],
            ['name' => 'Octavia Salma', 'email' => 'octavia.salma@siswa.sch.id', 'kelas' => 'XI PPLG 1'],
        ];

        foreach ($siswas as $siswa) {
            User::updateOrCreate(
                ['email' => $siswa['email']],
                [
                    'name' => $siswa['name'],
                    'password' => Hash::make('123456'),
                    'role' => 'siswa',
                    'kelas' => $siswa['kelas'],
                ]
            );
        }
    }
}
