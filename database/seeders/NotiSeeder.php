<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Noti::factory(20)->create();
    }
}
