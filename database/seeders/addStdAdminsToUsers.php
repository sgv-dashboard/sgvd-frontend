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

        DB::table('users')->insert([
            'name' => 'Siemen Vandervoort',
            'email' => 'siemen.vandervoort@student.uhasselt.be',
            'password' => '$2y$10$CVYzJJD.eLQUdmOw2Xosou0l4hC9bVEzkgNmoVylpj7UPBmR/Y0FC',
            'google_id' => '101425427774218065150',
            'verified' => 1,
            'admin' => 1,
        ]);
    }
}
