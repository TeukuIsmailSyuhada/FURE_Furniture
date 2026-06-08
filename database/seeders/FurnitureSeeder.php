<?php

namespace Database\Seeders;

use App\Models\Furniture;
use Illuminate\Database\Seeder;

class FurnitureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $furnitures = [
            [
                'code' => 'FUR-001',
                'category_id' => 1, // Sofa
                'location_id' => 1, // Ruang Tamu Utama
                'name' => 'Sofa Minimalis Aruna',
                'material' => 'Velvet',
                'color' => 'Beige',
                'size' => '200x90x80 cm',
                'weight' => '45 kg',
                'stock' => 10,
                'minimum_stock' => 2,
                'condition' => 'Baik',
                'status' => 'Aktif',
                'image' => 'furnitures/sofa.png',
                'description' => 'Sofa 3 seater untuk ruang tamu utama.'
            ],
            [
                'code' => 'FUR-002',
                'category_id' => 2, // Meja
                'location_id' => 2, // Ruang Rapat 1
                'name' => 'Meja Rapat Nordic',
                'material' => 'Kayu Jati',
                'color' => 'Natural Wood',
                'size' => '240x120x75 cm',
                'weight' => '60 kg',
                'stock' => 2,
                'minimum_stock' => 1,
                'condition' => 'Baik',
                'status' => 'Aktif',
                'image' => 'furnitures/meja_rapat_jati.jpg',
                'description' => 'Meja rapat besar gaya scandinavian.'
            ],
            [
                'code' => 'FUR-003',
                'category_id' => 4, // Lemari
                'location_id' => 4, // Gudang Inventaris A
                'name' => 'Lemari Dokumen Sena',
                'material' => 'MDF',
                'color' => 'Putih',
                'size' => '150x55x200 cm',
                'weight' => '80 kg',
                'stock' => 5,
                'minimum_stock' => 2,
                'condition' => 'Baik',
                'status' => 'Aktif',
                'image' => 'furnitures/lemari_sena.jpg',
                'description' => 'Lemari penyimpanan arsip kantor.'
            ],
            [
                'code' => 'FUR-004',
                'category_id' => 5, // Rak
                'location_id' => 6, // Cafe & Lounge
                'name' => 'Rak Buku Oslo',
                'material' => 'Kayu Pinus',
                'color' => 'Light Brown',
                'size' => '80x30x180 cm',
                'weight' => '30 kg',
                'stock' => 3,
                'minimum_stock' => 1,
                'condition' => 'Baik',
                'status' => 'Aktif',
                'image' => 'furnitures/rak_oslo.jpg',
                'description' => 'Rak buku untuk area santai.'
            ],
            [
                'code' => 'FUR-005',
                'category_id' => 3, // Kursi
                'location_id' => 5, // Gudang Perbaikan B
                'name' => 'Kursi Kerja Ergonomis',
                'material' => 'Mesh & Besi',
                'color' => 'Hitam',
                'size' => '60x60x110 cm',
                'weight' => '15 kg',
                'stock' => 4,
                'minimum_stock' => 2,
                'condition' => 'Rusak Ringan',
                'status' => 'Aktif',
                'image' => 'furnitures/kursi.png',
                'description' => 'Kursi kerja yang butuh sedikit perbaikan pada roda.'
            ],
            [
                'code' => 'FUR-006',
                'category_id' => 3, // Kursi
                'location_id' => 5, // Gudang Perbaikan B
                'name' => 'Kursi Tunggu Klasik',
                'material' => 'Kayu Tua',
                'color' => 'Coklat Gelap',
                'size' => '50x50x90 cm',
                'weight' => '8 kg',
                'stock' => 2,
                'minimum_stock' => 1,
                'condition' => 'Rusak Berat',
                'status' => 'Aktif',
                'image' => 'furnitures/kursi_tunggu_2.jpg',
                'description' => 'Kursi patah pada bagian kaki penyangga.'
            ],
            [
                'code' => 'FUR-007',
                'category_id' => 2, // Meja
                'location_id' => 5, // Gudang Perbaikan B
                'name' => 'Meja Cafe Bulat',
                'material' => 'Alumunium',
                'color' => 'Silver',
                'size' => 'Diameter 60cm',
                'weight' => '5 kg',
                'stock' => 3,
                'minimum_stock' => 1,
                'condition' => 'Dalam Perbaikan',
                'status' => 'Aktif',
                'image' => 'furnitures/meja_cafe.jpg',
                'description' => 'Sedang dalam pengecatan ulang.'
            ],
            [
                'code' => 'FUR-008',
                'category_id' => 1, // Sofa
                'location_id' => 3, // Ruang Direksi
                'name' => 'Sofa Kulit Premium',
                'material' => 'Leather',
                'color' => 'Black',
                'size' => '180x85x85 cm',
                'weight' => '50 kg',
                'stock' => 1,
                'minimum_stock' => 1,
                'condition' => 'Baik',
                'status' => 'Aktif',
                'image' => 'furnitures/sofa_premium_2.jpg',
                'description' => 'Sofa mewah untuk tamu direksi.'
            ],
            [
                'code' => 'FUR-009',
                'category_id' => 3, // Kursi
                'location_id' => 2, // Ruang Rapat 1
                'name' => 'Kursi Rapat Empuk',
                'material' => 'Kain & Busa',
                'color' => 'Abu-abu',
                'size' => '60x60x100 cm',
                'weight' => '12 kg',
                'stock' => 20,
                'minimum_stock' => 10,
                'condition' => 'Baik',
                'status' => 'Aktif',
                'image' => 'furnitures/kursi_rapat.jpg',
                'description' => 'Kursi nyaman untuk rapat.'
            ],
            [
                'code' => 'FUR-010',
                'category_id' => 5, // Rak
                'location_id' => 3, // Ruang Direksi
                'name' => 'Rak Pajangan Kaca',
                'material' => 'Kaca & Besi',
                'color' => 'Gold',
                'size' => '100x40x200 cm',
                'weight' => '40 kg',
                'stock' => 2,
                'minimum_stock' => 1,
                'condition' => 'Baik',
                'status' => 'Aktif',
                'image' => 'furnitures/rak_kaca.jpg',
                'description' => 'Rak mewah untuk piala dan ornamen.'
            ],
            [
                'code' => 'FUR-011',
                'category_id' => 2, // Meja
                'location_id' => 6, // Cafe & Lounge
                'name' => 'Meja Makan Minimalis',
                'material' => 'Kayu Mahoni',
                'color' => 'Natural',
                'size' => '120x80x75 cm',
                'weight' => '35 kg',
                'stock' => 5,
                'minimum_stock' => 2,
                'condition' => 'Rusak Ringan',
                'status' => 'Aktif',
                'image' => 'furnitures/meja_makan.jpg',
                'description' => 'Terdapat goresan di sisi pinggir meja.'
            ],
            [
                'code' => 'FUR-012',
                'category_id' => 4, // Lemari
                'location_id' => 3, // Ruang Direksi
                'name' => 'Credenza Mewah',
                'material' => 'Kayu Solid',
                'color' => 'Coklat Tua',
                'size' => '180x50x85 cm',
                'weight' => '65 kg',
                'stock' => 1,
                'minimum_stock' => 1,
                'condition' => 'Baik',
                'status' => 'Aktif',
                'image' => 'furnitures/credenza.jpg',
                'description' => 'Credenza klasik untuk menyimpan dokumen VIP.'
            ],
            [
                'code' => 'FUR-013',
                'category_id' => 1, // Sofa
                'location_id' => 6, // Cafe & Lounge
                'name' => 'Sofa Tunggal Retro',
                'material' => 'Kanvas',
                'color' => 'Kuning Mustard',
                'size' => '80x80x85 cm',
                'weight' => '25 kg',
                'stock' => 4,
                'minimum_stock' => 2,
                'condition' => 'Dalam Perbaikan',
                'status' => 'Aktif',
                'image' => 'furnitures/sofa_retro.jpg',
                'description' => 'Sedang diganti busanya.'
            ],
        ];

        foreach ($furnitures as $furniture) {
            Furniture::create($furniture);
        }
    }
}
