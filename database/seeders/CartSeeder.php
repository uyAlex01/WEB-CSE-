<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\User;
use App\Models\Event;

class CartSeeder extends Seeder
{
    public function run()
    {
        // Get a few users and events
        $users = User::take(3)->get();
        $events = Event::take(5)->get();

        foreach ($users as $user) {
            foreach ($events->random(2) as $event) {
                Cart::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'event_id' => $event->id,
                    ],
                    [
                        'quantity' => rand(1, 3),
                    ]
                );
            }
        }

        $this->command->info('Sample cart items added for users.');
    }
}
