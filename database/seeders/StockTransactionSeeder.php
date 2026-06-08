<?php

namespace Database\Seeders;

use App\Models\StockTransaction;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StockTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            [
                'furniture_id' => 1,
                'type' => 'Masuk',
                'quantity' => 10,
                'transaction_date' => Carbon::now()->subDays(10)->toDateString(),
                'note' => 'Stok awal dari supplier.'
            ],
            [
                'furniture_id' => 2,
                'type' => 'Masuk',
                'quantity' => 5,
                'transaction_date' => Carbon::now()->subDays(8)->toDateString(),
                'note' => 'Penambahan meja ruang rapat.'
            ],
            [
                'furniture_id' => 3,
                'type' => 'Masuk',
                'quantity' => 7,
                'transaction_date' => Carbon::now()->subDays(7)->toDateString(),
                'note' => 'Kiriman dari pabrik.'
            ],
            [
                'furniture_id' => 3,
                'type' => 'Keluar',
                'quantity' => 2,
                'transaction_date' => Carbon::now()->subDays(5)->toDateString(),
                'note' => 'Ditempatkan di ruang staff HRD.'
            ],
            [
                'furniture_id' => 4,
                'type' => 'Masuk',
                'quantity' => 3,
                'transaction_date' => Carbon::now()->subDays(4)->toDateString(),
                'note' => 'Stok baru untuk lounge.'
            ],
            [
                'furniture_id' => 5,
                'type' => 'Keluar',
                'quantity' => 1,
                'transaction_date' => Carbon::now()->subDays(3)->toDateString(),
                'note' => 'Dikirim ke ruang mekanik untuk perbaikan.'
            ],
            [
                'furniture_id' => 2,
                'type' => 'Keluar',
                'quantity' => 3,
                'transaction_date' => Carbon::now()->subDays(1)->toDateString(),
                'note' => 'Distribusi ke ruang direksi.'
            ],
            [
                'furniture_id' => 6,
                'type' => 'Masuk',
                'quantity' => 2,
                'transaction_date' => Carbon::now()->subDays(15)->toDateString(),
                'note' => 'Barang masuk kondisi kurang baik.'
            ],
            [
                'furniture_id' => 8,
                'type' => 'Masuk',
                'quantity' => 1,
                'transaction_date' => Carbon::now()->toDateString(),
                'note' => 'Sofa VIP baru.'
            ],
            [
                'furniture_id' => 9,
                'type' => 'Masuk',
                'quantity' => 20,
                'transaction_date' => Carbon::now()->subDays(2)->toDateString(),
                'note' => 'Pembelian grosir.'
            ]
        ];

        foreach ($transactions as $transaction) {
            StockTransaction::create($transaction);
        }
    }
}
