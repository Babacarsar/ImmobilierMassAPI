<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Appartements à louer', 'slug' => 'appartements-louer']);
        Category::create(['name' => 'Terrains à vendre', 'slug' => 'terrains-vendre']);
    }
}
