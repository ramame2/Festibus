<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamps();
        });

    }
        /**
         * Reverse the migrations.
         *
         * @return void
         */
    public function down()
    {
        // Alleen de tabel verwijderen als deze bestaat
        if (Schema::hasTable('locations')) {
            Schema::dropIfExists('locations');
        }

    }
}
