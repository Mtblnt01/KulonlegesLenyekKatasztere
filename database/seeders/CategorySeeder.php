<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mitológiai lények',
                'description' => 'Különböző mitológiákból származó legendás teremtmények'
            ],
            [
                'name' => 'Mágikus lények',
                'description' => 'Természetfeletti képességekkel rendelkező varázslatos teremtmények'
            ],
            [
                'name' => 'Óriások',
                'description' => 'Hatalmas méretű, erős lények'
            ],
            [
                'name' => 'Sárkányok',
                'description' => 'Szárnyas, tűzokádó hatalmas hüllők'
            ],
            [
                'name' => 'Éjszakai lények',
                'description' => 'A sötétség és az árnyékok teremtményei'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
