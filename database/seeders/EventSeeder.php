<?php

namespace Database\Seeders;

use App\Models\Creature;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $creatures = Creature::all();

        if ($creatures->isEmpty()) {
            return;
        }

        $events = [
            [
                'name' => 'Első megjelenés',
                'description' => 'A lény első alkalommal lett észlelve emberek által',
                'event_date' => now()->subMonths(6),
                'location' => 'Kárpátok',
            ],
            [
                'name' => 'Csata a falunál',
                'description' => 'Összecsapás a közeli település védőivel',
                'event_date' => now()->subMonths(3),
                'location' => 'Sötét-völgy',
            ],
            [
                'name' => 'Békés találkozás',
                'description' => 'Első sikeres kommunikációs kísérlet',
                'event_date' => now()->subMonth(),
                'location' => 'Varázsló-torony',
            ],
            [
                'name' => 'Területi konfliktus',
                'description' => 'Két lény összecsapása ugyanazon területért',
                'event_date' => now()->subWeeks(2),
                'location' => 'Ősi erdő',
            ],
        ];

        foreach ($creatures as $creature) {
            // Minden lényhez 1-3 eseményt rendelünk
            $numEvents = rand(1, 3);
            $selectedEvents = collect($events)->random($numEvents);

            foreach ($selectedEvents as $eventData) {
                Event::create([
                    'creature_id' => $creature->id,
                    'name' => $eventData['name'],
                    'description' => $eventData['description'],
                    'event_date' => $eventData['event_date'],
                    'location' => $eventData['location'],
                ]);
            }
        }
    }
}
