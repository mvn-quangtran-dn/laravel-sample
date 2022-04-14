<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'VN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'JP',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        Country::insert($data);
    }
}
