<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatebusroutesTable extends Migration
{
    public function up()
    {
        // Controleer of de tabel niet bestaat voordat deze wordt aangemaakt
        if (!Schema::hasTable('bus_routes')) {
            Schema::create('bus_routes', function (Blueprint $table) {
                $table->id();
                $table->string('departure_id');
                $table->string('destination_id');
                $table->time('departure_time');
                $table->time('duration');
                $table->decimal('costs', 10, 2);
                $table->timestamps();
            });
        } else {

            echo "De 'bus_routes' tabel bestaat al, migratie wordt overgeslagen.\n";
        }
    }

    public function down()
    {
        // Alleen de tabel verwijderen als deze bestaat
        if (Schema::hasTable('bus_routes')) {
            Schema::dropIfExists('bus_routes');
        }
    }
}
