<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comps = [
            [
                'name' => 'Senior Zsolt',
                'birth' => 1999,
                'teams_id' => 2,
                'federal_reg_code' => '31/123',
                'team_reg_code' => '31001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Senior Bence',
                'birth' => 1999,
                'teams_id' => 2,
                'federal_reg_code' => '31/312',
                'team_reg_code' => '31002',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('competitors')->insert($comps);
    }
}
