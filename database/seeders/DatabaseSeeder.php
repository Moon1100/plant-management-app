<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create or get a test user
        $user = User::firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            // Use a known password for the seeded user
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create a demo farm for the user if they don't have one
        $farm = \App\Models\Farm::where('user_id', $user->id)->first();
        if (! $farm) {
            $farm = \App\Models\Farm::factory()->for($user)->create([
                'name' => 'Demo Farm',
                'description' => 'A demo farm created by the seeder',
                'is_public' => true,
            ]);
        }

        // Ensure there are at least 5 plants for that farm
        if ($farm->plants()->count() < 5) {
            \App\Models\Plant::factory()->count(5 - $farm->plants()->count())->for($farm)->create();
        }
    }
}
