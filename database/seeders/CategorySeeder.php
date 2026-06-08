<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Sofa', 'Meja', 'Kursi', 'Lemari', 'Rak', 'Tempat Tidur', 'Dekorasi'];
        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => str()->slug($cat),
                'description' => "Kategori untuk furniture jenis $cat"
            ]);
        }
    }
}
