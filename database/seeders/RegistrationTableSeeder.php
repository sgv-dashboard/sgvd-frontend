<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RegistrationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 20; $i++) {
            DB::table('registrations')->insert([
                'userId' => 1,
                'activityId' => $i,
            ]);
        }

        for ($i = 1; $i < 20; $i++) {
            DB::table('registrations')->insert([
                'userId' => 2,
                'activityId' => $i,
            ]);
        }
    }
}
