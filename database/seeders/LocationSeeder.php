<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            ['name' => 'Ruang Tamu Utama', 'description' => 'Area lobi dan ruang tamu depan.'],
            ['name' => 'Ruang Rapat 1', 'description' => 'Ruang rapat kapasitas 10 orang.'],
            ['name' => 'Ruang Direksi', 'description' => 'Ruangan khusus pimpinan.'],
            ['name' => 'Gudang Inventaris A', 'description' => 'Tempat penyimpanan barang stok baru.'],
            ['name' => 'Gudang Perbaikan B', 'description' => 'Area untuk barang yang sedang diperbaiki.'],
            ['name' => 'Cafe & Lounge', 'description' => 'Area istirahat karyawan dan tamu.'],
            ['name' => 'Outdoor Terrace', 'description' => 'Area terbuka belakang gedung.'],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
