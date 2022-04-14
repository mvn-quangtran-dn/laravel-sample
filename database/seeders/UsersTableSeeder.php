<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //code insert data
        //C1

        // User::create($data);

        //C2 Dung factory
        User::factory()
        ->count(50)
        ->hasProfile(1)
        ->create();

    }
}
