<?php

namespace Database\Seeders;

use App\Models\AddNew;
use Illuminate\Database\Seeder;
use Database\Seeders\NotiSeeder;
use Database\Seeders\AnnouncementSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            NotiSeeder::class,
            AnnouncementSeeder::class,
            AddNew::class,
        ]);
    }
}
