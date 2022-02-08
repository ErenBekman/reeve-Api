<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddNewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\AddNew::factory(10)->create();
    }
}
