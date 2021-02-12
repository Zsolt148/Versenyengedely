<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\User::factory(10)->create();
        $this->call([
           TeamSeeder::class,
           CompetitorSeeder::class,
        ]);

        DB::table('users')->insert([
            'name' => 'Budai Zsolt',
            'email' => 'b.zsolt148@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'type' => 'coach',
            'teams_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
