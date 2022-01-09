<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class addStdAdminsToUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Lowie Deferme',
            'email' => 'lowie.deferme@student.uhasselt.be',
            'password' => '$2y$10$kuvuw.IsOicj82W.EfUAh.UEgcW1jDuwtAOj7Hu02fq6iav20utWK',
            'google_id' => '113232333972974283320',
            'verified' => 1,
            'admin' => 1,
        ]);
    }
}
