<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AboutUsSeeder::class,
            PrivacyPolicySeeder::class,
            TermConditionSeeder::class,
            SettingSeeder::class,
            UserSeeder::class,
            ThemeSeeder::class
        ]);
    }
}
