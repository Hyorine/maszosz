<?php

namespace Database\Seeders;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Egyébb', 'description' => ''],
            ['name' => 'Lényprofilok', 'description' => ''],
            ['name' => 'Vadászati technikák', 'description' => ''],
            ['name' => 'Felszerelésértékelés', 'description' => ''],
            ['name' => 'Túlélési készségek', 'description' => ''],
            ['name' => 'Biztonsági tippek', 'description' => ''],
            ['name' => 'Vadászattörténetek', 'description' => ''],
            ['name' => 'Kutatás és elemzés', 'description' => ''],
            ['name' => 'Képzés és oktatás', 'description' => ''],
            // Add more categories as needed
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
