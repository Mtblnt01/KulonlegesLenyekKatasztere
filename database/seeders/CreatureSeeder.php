<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Creature;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            return;
        }

        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            return;
        }

        $creatures = [
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Sárkányok')->first()->id ?? $categories->random()->id,
                'name' => 'Tűzsárkány',
                'description' => 'Egy ősi, tűzokádó sárkány, aki hegyekben lakik és kincseket gyűjt.',
                'origin' => 'Kárpátok',
                'danger_level' => 10,
                'is_magical' => true,
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Éjszakai lények')->first()->id ?? $categories->random()->id,
                'name' => 'Árnyékkígyó',
                'description' => 'Láthatatlanná váló kígyó, amely csak éjszaka vadászik.',
                'origin' => 'Erdélyi erdők',
                'danger_level' => 7,
                'is_magical' => true,
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Mágikus lények')->first()->id ?? $categories->random()->id,
                'name' => 'Kristálymanó',
                'description' => 'Apró, kristályokból álló lény, aki fényt sugároz.',
                'origin' => 'Barlangok',
                'danger_level' => 2,
                'is_magical' => true,
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Mágikus lények')->first()->id ?? $categories->random()->id,
                'name' => 'Villámfarkas',
                'description' => 'Elektromos kisüléseket okozó farkas, rendkívül gyors.',
                'origin' => 'Síkság',
                'danger_level' => 8,
                'is_magical' => true,
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('name', 'Mitológiai lények')->first()->id ?? $categories->random()->id,
                'name' => 'Időtükör',
                'description' => 'Élő tükör, amely az idő múlását mutatja és manipulálja.',
                'origin' => 'Ismeretlen',
                'danger_level' => 9,
                'is_magical' => true,
            ],
        ];

        foreach ($creatures as $creatureData) {
            $creature = Creature::create($creatureData);
            
            // Attach random abilities to each creature
            $abilityIds = range(1, 8);
            shuffle($abilityIds);
            $randomAbilities = array_slice($abilityIds, 0, rand(2, 4));
            $creature->abilities()->attach($randomAbilities);
        }
    }
}
