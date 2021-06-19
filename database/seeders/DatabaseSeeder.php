<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
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
        Category::create(['name' => 'Standard']);
        Category::create(['name' => 'Nature']);
        Category::create(['name' => 'Alarms']);
        Category::create(['name' => 'SMS']);
        Category::create(['name' => 'Music']);
        Category::create(['name' => 'Funny']);
        Category::create(['name' => 'Holiday']);

        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123qwe'),
            'email_verified_at' => now()
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
