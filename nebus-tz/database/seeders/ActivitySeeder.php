<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        {
            // Creating parent activities
            $food = Activity::create([
                'name' => 'Еда',
                'parent_id' => null,
            ]);

            $automobile = Activity::create([
                'name' => 'Автомобили',
                'parent_id' => null,
            ]);

            // Creating child activities for 'Еда' (Food)
            $meat = Activity::create([
                'name' => 'Мясная продукция',
                'parent_id' => $food->id,
            ]);

            $milk = Activity::create([
                'name' => 'Молочная продукция',
                'parent_id' => $food->id,
            ]);

            // Creating further child activities under 'Молочная продукция'
            $cheese = Activity::create([
                'name' => 'Сыр',
                'parent_id' => $milk->id,
            ]);

            $butter = Activity::create([
                'name' => 'Масло',
                'parent_id' => $milk->id,
            ]);

            // Creating child activities for 'Автомобили' (Automobiles)
            $cargo = Activity::create([
                'name' => 'Грузовые',
                'parent_id' => $automobile->id,
            ]);

            $passenger = Activity::create([
                'name' => 'Легковые',
                'parent_id' => $automobile->id,
            ]);

            // Creating further child activities under 'Легковые' (Passenger)
            $spare_parts = Activity::create([
                'name' => 'Запчасти',
                'parent_id' => $passenger->id,
            ]);

            $accessories = Activity::create([
                'name' => 'Аксессуары',
                'parent_id' => $passenger->id,
            ]);
        }
    }
}
