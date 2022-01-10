<?php

namespace Tests\Unit;

use App\Models\Person;
use App\Models\Planet;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PersonTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function it_belongs_to_a_planet()
    {
        $earth = Planet::factory()->create();

        $mark = Person::factory()->create(['planet_id' => $earth->id]);

        $this->assertInstanceOf(Planet::class, $mark->planet);
        $this->assertEquals($earth->name, $mark->planet->name);
    }
}
