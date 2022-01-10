<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $limit = 10;
        $page = $request->query('page') ?? 1;

        $people = Person::query();

        if ($search = $request->query('search')) {
            $people = $people->where('name', 'like', "%{$search}%");
        }

        if ($sortBy = $request->query('sortBy')) {
            [$field, $direction] = explode(',', $sortBy);
            $people = $people->orderBy($field, $direction);
        }

        $people = $people->skip($limit * ($page - 1))->take($limit);

        $peopleCount = Person::count();
        $nextPage = $this->getNextPage($page, $peopleCount);
        $prevPage = $this->getPrevPage($page);

        return response()->json([
            'count' => $peopleCount,
            'next' => $nextPage ? route('people.index', ['page' => $nextPage]) : null,
            'previous' => $prevPage ? route('people.index', ['page' => $prevPage]) : null,
            'results' => $people->get(),
        ]);
    }

    protected function getNextPage($actualPage, $peopleCount)
    {
        $nextPage = null;

        if (ceil($peopleCount / 10) <= $actualPage) {
            $nextPage = null;
        } else {
            $nextPage = ($actualPage + 1);
        }

        return $nextPage;
    }

    protected function getPrevPage($actualPage)
    {
        $prevPage = null;

        if ($actualPage <= 1) {
            $prevPage = null;
        } else {
            $prevPage = ($actualPage - 1);
        }

        return $prevPage;
    }

    public function show(Request $request, $personId)
    {
        return response()->json([
            'count' => 1,
            'next' => null,
            'previous' => null,
            'results' => new Collection([Person::findOrFail($personId)]),
        ]);
    }
}
