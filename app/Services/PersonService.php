<?php

namespace App\Services;

use App\Models\Person;
use App\Traits\Paginatable;
use Illuminate\Support\Facades\Http;

class PersonService
{
    use Paginatable;

    public function getPeople($page = 1)
    {
        return Http::get("https://swapi.dev/api/people?page={$page}")->json();
    }

    public function savePerson($data)
    {
        $person = Person::create([
            'name' => $data['name'],
            'planet_id' => basename($data['homeworld']),
            'birth_year' => $data['birth_year'],
            'eye_color' => $data['eye_color'],
            'gender' => $data['gender'],
            'hair_color' => $data['hair_color'],
            'height' => $data['height'],
            'mass' => $data['mass'],
            'skin_color' => $data['skin_color'],
        ]);
    }

    public function importPeople()
    {
        $page = 1;
        $hasNext = false;

        do {
            dump('asking people page ' . $page);

            $people = $this->getPeople($page);

            if (isset($people['next'])) {
                $hasNext = true;
                $page = self::getPageFromQueryString($people['next']);
            } else {
                $hasNext = false;
            }

            foreach ($people['results'] as $person) {
                logger('person ' . $person['name']);
                $this->savePerson($person);
            }
        } while ($hasNext);
    }
}
