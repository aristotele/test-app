<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();


            $table->string('name'); /* -- The name of this person.*/
            $table->foreignId('planet_id')->constrained('planets');
            $table->string('birth_year'); /* -- The birth year of the person, using the in-universe standard of BBY or ABY - Before the Battle of Yavin or After the Battle of Yavin. The Battle of Yavin is a battle that occurs at the end of Star Wars episode IV: A New Hope. */
            $table->string('eye_color'); /* -- The eye color of this person. Will be "unknown" if not known or "n/a" if the person does not have an eye. */
            $table->string('gender'); /* -- The gender of this person. Either "Male", "Female" or "unknown", "n/a" if the person does not have a gender. */
            $table->string('hair_color'); /* -- The hair color of this person. Will be "unknown" if not known or "n/a" if the person does not have hair. */
            $table->string('height'); /* -- The height of the person in centimeters. */
            $table->string('mass'); /* -- The mass of the person in kilograms. */
            $table->string('skin_color'); /* -- The skin color of this person. */

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
        Schema::dropIfExists('people');
    }
}
