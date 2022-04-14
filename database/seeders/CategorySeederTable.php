<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            [
                'name' => 'Dien Thoai',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => 'Laptop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sim',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        Category::insert($data);
    }
}
