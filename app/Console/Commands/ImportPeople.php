<?php

namespace App\Console\Commands;

use App\Services\PersonService;
use App\Services\PlanetService;
use Illuminate\Console\Command;

class ImportPeople extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'people:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import people from SW Api!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(PlanetService $planetService, PersonService $personService)
    {
        $planetService->importPlanets();
        $personService->importPeople();

        return 0;
    }
}
