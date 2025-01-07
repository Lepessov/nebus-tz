<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Creating multiple buildings
        Building::create([
            'address' => 'г. Москва, ул. Ленина 1, офис 3',
            'latitude' => 55.7558,
            'longitude' => 37.6176,
        ]);

        Building::create([
            'address' => 'г. Санкт-Петербург, ул. Невский 15, офис 5',
            'latitude' => 59.9343,
            'longitude' => 30.3351,
        ]);

        Building::create([
            'address' => 'г. Екатеринбург, ул. Ленина 45, офис 2',
            'latitude' => 56.8389,
            'longitude' => 60.6057,
        ]);

        Building::create([
            'address' => 'г. Новосибирск, ул. Красный проспект 20, офис 4',
            'latitude' => 55.0084,
            'longitude' => 82.9357,
        ]);

        Building::create([
            'address' => 'г. Казань, ул. Баумана 10, офис 1',
            'latitude' => 55.7941,
            'longitude' => 49.1250,
        ]);
    }
}
