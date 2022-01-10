<?php

namespace Tests\Unit;

use App\Models\Person;
use Tests\TestCase;
use App\Models\Planet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlanetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_may_have_many_residents()
    {
        $earth = Planet::factory()->create();

        $earthPeople = Person::factory()->count(5)->create(['planet_id' => $earth->id]);
        $marsPeople = Person::factory()->count(3)->create();

        tap($earth->residents, function ($residents) {
            $this->assertInstanceOf(Collection::class, $residents);
            $this->assertCount(5, $residents);
        });
    }
}
