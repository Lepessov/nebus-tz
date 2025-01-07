<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Organization;
use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_organization()
    {
        $building = Building::create([
            'address' => 'г. Москва, ул. Ленина 1, офис 3',
            'latitude' => 55.7558,
            'longitude' => 37.6176,
        ]);

        $organization = Organization::create([
            'name' => 'ООО Молоко-Люкс',
            'phone' => '8-800-555-35-35',
            'building_id' => $building->id,
        ]);

        $this->assertDatabaseHas('organizations', [
            'name' => 'ООО Молоко-Люкс',
        ]);
    }

    /** @test */
    public function it_belongs_to_a_building()
    {
        $building = Building::create([
            'address' => 'г. Москва, ул. Ленина 1, офис 3',
            'latitude' => 55.7558,
            'longitude' => 37.6176,
        ]);

        $organization = Organization::create([
            'name' => 'ООО Молоко-Люкс',
            'phone' => '8-800-555-35-35',
            'building_id' => $building->id,
        ]);

        $this->assertTrue($organization->building->is($building));
    }

    /** @test */
    public function it_has_many_activities()
    {
        $building = Building::create([
            'address' => 'г. Москва, ул. Ленина 1, офис 3',
            'latitude' => 55.7558,
            'longitude' => 37.6176,
        ]);

        $activity = Activity::create([
            'name' => 'Молочная продукция',
            'parent_id' => null,
        ]);

        $organization = Organization::create([
            'name' => 'ООО Молоко-Люкс',
            'phone' => '8-800-555-35-35',
            'building_id' => $building->id,
        ]);

        $organization->activities()->attach($activity);

        $this->assertTrue($organization->activities->contains($activity));
    }
}

