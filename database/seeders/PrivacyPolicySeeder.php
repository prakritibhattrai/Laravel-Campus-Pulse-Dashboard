<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privacy_policies')->insert([
            'content' => 'Privacy Policy',
            'created_at' => Carbon::now(),
        ]);
    }
}
