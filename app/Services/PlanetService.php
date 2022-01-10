<?php

namespace App\Services;

use App\Models\Planet;
use App\Traits\Paginatable;
use Illuminate\Support\Facades\Http;

class PlanetService
{
    use Paginatable;

    public function savePlanet($data)
    {
        $planet = Planet::create([
            'name' => $data['name'],
            'diameter' => $data['diameter'],
            'orbital_period' => $data['orbital_period'],
            'rotation_period' => $data['rotation_period'],
            'gravity' => $data['gravity'],
            'population' => $data['population'],
            'climate' => $data['climate'],
            'terrain' => $data['terrain'],
            'surface_water' => $data['surface_water'],
        ]);
    }

    public function getPlanets($page = 1)
    {
        return Http::get("https://swapi.dev/api/planets?page={$page}")->json();
    }

    public function importPlanets()
    {
        $page = 1;
        $hasNext = false;

        do {
            dump('asking planet page ' . $page);

            $planets = $this->getPlanets($page);

            // logger('next ' . $planets['next']);
            if (isset($planets['next'])) {
                $hasNext = true;
                $page = self::getPageFromQueryString($planets['next']);
            } else {
                $hasNext = false;
            }

            foreach ($planets['results'] as $planet) {
                logger('planet ' . $planet['name']);
                $this->savePlanet($planet);
            }
        } while ($hasNext);
    }
}
