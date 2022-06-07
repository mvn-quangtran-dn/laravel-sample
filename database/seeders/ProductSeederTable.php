<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product::factory()->count(50)->create();
        for($i = 1; $i <=10; $i++){
            $data = [
                'name' => 'Product'.$i,
                'quantity' => rand(1,100),
                'price' => rand(10000,100000000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            \DB::table('products')->insert($data);
        }
    }
}
