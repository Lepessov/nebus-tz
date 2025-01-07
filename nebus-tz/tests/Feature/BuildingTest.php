<?php

namespace Tests\Feature;

use App\Models\Building;
use App\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BuildingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_building()
    {
        $building = Building::create([
            'address' => 'г. Москва, ул. Ленина 1, офис 3',
            'latitude' => 55.7558,
            'longitude' => 37.6176,
        ]);

        $this->assertDatabaseHas('buildings', [
            'address' => 'г. Москва, ул. Ленина 1, офис 3',
        ]);
    }

    /** @test */
    public function it_has_many_organizations()
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

        $this->assertTrue($building->organizations->contains($organization));
    }
}
