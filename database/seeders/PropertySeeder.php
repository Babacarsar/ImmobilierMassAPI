<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $locationCategory = Category::where('slug', 'appartements-louer')->first();
        $terrainCategory  = Category::where('slug', 'terrains-vendre')->first();

        if (! $locationCategory || ! $terrainCategory) {
            return;
        }

        // Appartements à louer
        $appartements = [
            [
                'title'       => 'Appartement 3 pièces centre-ville',
                'description' => 'Bel appartement lumineux proche des commerces et transports.',
                'price'       => 750000,
                'location'    => 'Dakar, Plateau',
                'surface'     => 85,
                'rooms'       => 3,
                'featured'    => true,
            ],
            [
                'title'       => 'Studio meublé proche université',
                'description' => 'Idéal étudiant, entièrement meublé, charges comprises.',
                'price'       => 350000,
                'location'    => 'Dakar, Fann',
                'surface'     => 25,
                'rooms'       => 1,
                'featured'    => false,
            ],
        ];

        foreach ($appartements as $data) {
            Property::create([
                'category_id' => $locationCategory->id,
                'title'       => $data['title'],
                'slug'        => Str::slug($data['title']) . '-' . uniqid(),
                'description' => $data['description'],
                'price'       => $data['price'],
                'location'    => $data['location'],
                'surface'     => $data['surface'],
                'rooms'       => $data['rooms'],
                'status'      => 'disponible',
                'featured'    => $data['featured'],
            ]);
        }

        // Terrains à vendre
        $terrains = [
            [
                'title'       => 'Terrain 500 m² zone résidentielle',
                'description' => 'Terrain viabilisé idéal pour projet de villa.',
                'price'       => 25000000,
                'location'    => 'Diamniadio',
                'surface'     => 500,
                'rooms'       => null,
                'featured'    => true,
            ],
            [
                'title'       => 'Terrain agricole 2 hectares',
                'description' => 'Parfait pour projet agricole ou ferme.',
                'price'       => 18000000,
                'location'    => 'Thiès',
                'surface'     => 20000,
                'rooms'       => null,
                'featured'    => false,
            ],
        ];

        foreach ($terrains as $data) {
            Property::create([
                'category_id' => $terrainCategory->id,
                'title'       => $data['title'],
                'slug'        => Str::slug($data['title']) . '-' . uniqid(),
                'description' => $data['description'],
                'price'       => $data['price'],
                'location'    => $data['location'],
                'surface'     => $data['surface'],
                'rooms'       => $data['rooms'],
                'status'      => 'disponible',
                'featured'    => $data['featured'],
            ]);
        }
    }
}
