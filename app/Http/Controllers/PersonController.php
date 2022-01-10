<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $people = Person::query();

        if ($search = $request->query('search')) {
            $people = $people->where('name', 'like', "%{$search}%");
        }

        if ($sortBy = $request->query('sortBy')) {
            [$field, $direction] = explode(',', $sortBy);
            $people = $people->orderBy($field, $direction);
        }

        if ($page = $request->query('page')) {
            $limit = 10;
            $people = $people->skip($limit * ($page - 1))->take($limit);
        }

        $peopleCount = Person::count();

        $nextPage = null;
        $prevPage = null;

        if (isset($page)) {
            if (ceil($peopleCount / 10) <= $page) {
                $nextPage = null;
            } else {
                $nextPage = ($page + 1);
            }
        }

        if (isset($page)) {
            if ($page <= 1) {
                $prevPage = null;
            } else {
                $prevPage = ($page - 1);
            }
        }

        return response()->json([
            'count' => $peopleCount,
            'next' => isset($nextPage) ? route('people.index', ['page' => $nextPage]) : null,
            'previous' => isset($prevPage) ? route('people.index', ['page' => $prevPage]) : null,
            'results' => $people->get(),
        ]);
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
