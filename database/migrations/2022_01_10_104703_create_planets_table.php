<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->id();

            $table->string('name'); /* -- The name of this planet. */
            $table->string('diameter'); /* -- The diameter of this planet in kilometers. */
            $table->string('orbital_period'); /* -- The number of standard days it takes for this planet to complete a single orbit of its local star. */
            $table->string('rotation_period'); /* -- The number of standard hours it takes for this planet to complete a single rotation on its axis. */
            $table->string('gravity'); /* -- A number denoting the gravity of this planet, where "1" is normal or 1 standard G. "2" is twice or 2 standard Gs. "0.5" is half or 0.5 standard Gs. */
            $table->string('population'); /* -- The average population of sentient beings inhabiting this planet. */
            $table->string('climate'); /* -- The climate of this planet. Comma separated if diverse. */
            $table->string('terrain'); /* -- The terrain of this planet. Comma separated if diverse. */
            $table->string('surface_water'); /* -- The percentage of the planet surface that is naturally occurring water or bodies of water. */
            // $table->json('residents');; /* array -- An array of People URL Resources that live on this planet. */

            $table->string('created'); /* -- the ISO 8601 date format of the time that this resource was created. */
            $table->string('edited'); /* -- the ISO 8601 date format of the time that this resource was edited. */

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planets');
    }
}
