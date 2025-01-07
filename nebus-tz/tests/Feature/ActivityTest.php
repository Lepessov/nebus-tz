<?php

namespace Tests\Feature;

use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_activity()
    {
        $activity = Activity::create([
            'name' => 'Молочная продукция',
            'parent_id' => null,
        ]);

        $this->assertDatabaseHas('activities', [
            'name' => 'Молочная продукция',
        ]);
    }

    /** @test */
    public function it_has_children_activities()
    {
        $parentActivity = Activity::create([
            'name' => 'Еда',
            'parent_id' => null,
        ]);

        $childActivity = Activity::create([
            'name' => 'Молочная продукция',
            'parent_id' => $parentActivity->id,
        ]);

        $this->assertTrue($parentActivity->children->contains($childActivity));
    }
}

