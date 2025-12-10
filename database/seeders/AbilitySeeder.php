<?php

namespace Database\Seeders;

use App\Models\Ability;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $abilities = [
            [
                'name' => 'Tűzlehelet',
                'description' => 'Hatalmas lángokat képes kilövellni a szájából',
                'type' => 'offensive',
                'power_level' => 9,
            ],
            [
                'name' => 'Láthatatlanság',
                'description' => 'Akaratlagosan láthatatlanná válhat környezete előtt',
                'type' => 'defensive',
                'power_level' => 7,
            ],
            [
                'name' => 'Teleportálás',
                'description' => 'Azonnali áthelyezés egyik helyről a másikra',
                'type' => 'support',
                'power_level' => 8,
            ],
            [
                'name' => 'Időmanipuláció',
                'description' => 'Az idő folyásának lassítása vagy gyorsítása',
                'type' => 'support',
                'power_level' => 10,
            ],
            [
                'name' => 'Gondolatolvasás',
                'description' => 'Mások gondolatainak olvasása és megértése',
                'type' => 'support',
                'power_level' => 6,
            ],
            [
                'name' => 'Villámlás',
                'description' => 'Elektromos kisülések létrehozása és irányítása',
                'type' => 'offensive',
                'power_level' => 8,
            ],
            [
                'name' => 'Gyógyítás',
                'description' => 'Sebek és betegségek mágikus gyógyítása',
                'type' => 'support',
                'power_level' => 7,
            ],
            [
                'name' => 'Alakváltás',
                'description' => 'Más élőlények formáját felvételni',
                'type' => 'defensive',
                'power_level' => 9,
            ],
        ];

        foreach ($abilities as $ability) {
            Ability::create($ability);
        }
    }
}
