<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un admin user pour le back-office
        User::factory()->create([
            'name' => 'Admin Immobilier',
            'email' => 'admin@immobilier.com',
            'password' => bcrypt('password'),  // mot de passe: "password"
        ]);

        // Nos seeders personnalisés
        $this->call([
            CategorySeeder::class,
        ]);
    }
}
