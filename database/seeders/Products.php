<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductPhoto;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'ProductName' => 'Baju Lebaran',
            'photo' => '1682572287_7596006070.jpeg',
            'price' => 250000,
            'description' => 'Baju koko lengan panjang cocok untuk halal bihalal saat lebaran cocok juga dipakai sehari hari untuk sholat di masjid',
            'category' => 'top',
            'stock' => 100
        ]);

        ProductPhoto::create([
            'product_id' => 1,
            'photo' => '1682572274_2335419588.jpeg'
        ]);

        Product::create([
            'ProductName' => 'Kerudung Lebaran',
            'photo' => '9602353429.jpeg',
            'price' => 200000,
            'description' => 'Kerudung cocok untuk dipakai sehari hari, kain lembut dan tidak panas.',
            'category' => 'hijab',
            'stock' => 100
        ]);
    }
}
