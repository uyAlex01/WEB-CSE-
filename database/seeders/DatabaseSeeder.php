<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     // Create test users
    User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    User::factory(5)->create();

    // Create fake events
    Event::factory(30)->create();

    $this->call([
        AdminSeeder::class,
        ]);
    
     $this->call([
            CategoriesTableSeeder::class,
            // Add other seeders here
        ]);
    
    $this->call([
    AdminSeeder::class,
    CategoriesTableSeeder::class,
    CartSeeder::class, // ✅ Add this
]);

}
}
