<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Building;
use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Creating an organization for the building and activity
        $building1 = Building::find(1); // Москва, ул. Ленина 1
        $activity1 = Activity::where('name', 'Молочная продукция')->first(); // Молочная продукция

        Organization::create([
            'name' => 'ООО Молоко-Люкс',
            'building_id' => $building1->id,
        ])->activities()->attach($activity1);

        $building2 = Building::find(2); // Санкт-Петербург, ул. Невский 15
        $activity2 = Activity::where('name', 'Грузовые')->first(); // Грузовые автомобили

        Organization::create([
            'name' => 'Транспортная Компания',
            'building_id' => $building2->id,
        ])->activities()->attach($activity2);

        $building3 = Building::find(3); // Екатеринбург, ул. Ленина 45
        $activity3 = Activity::where('name', 'Мясная продукция')->first(); // Мясная продукция
        $activity4 = Activity::where('name', 'Запчасти')->first(); // Запчасти для автомобилей

        Organization::create([
            'name' => 'Мясокомбинат Урал',
            'building_id' => $building3->id,
        ])->activities()->attach([$activity3->id, $activity4->id]);

        $building4 = Building::find(4); // Новосибирск, ул. Красный проспект 20
        $activity5 = Activity::where('name', 'Легковые')->first(); // Легковые автомобили

        Organization::create([
            'name' => 'Автосервис Профи',
            'building_id' => $building4->id,
        ])->activities()->attach($activity5);

        $building5 = Building::find(5); // Казань, ул. Баумана 10
        $activity6 = Activity::where('name', 'Аксессуары')->first(); // Аксессуары

        Organization::create([
            'name' => 'Автоаксессуары Татарстан',
            'building_id' => $building5->id,
        ])->activities()->attach($activity6);
    }
}
