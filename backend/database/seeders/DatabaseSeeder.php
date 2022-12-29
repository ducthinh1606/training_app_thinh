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
        \App\Models\User::factory(1)->create();
        \App\Models\TaskStatus::factory()->count(3)->sequence(
            ['status_name' => 'New'],
            ['status_name' => 'Doing'],
            ['status_name' => 'Done']
        )->create();
    }
}
