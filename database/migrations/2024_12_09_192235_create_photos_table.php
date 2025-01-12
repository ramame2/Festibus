<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Controleer of de tabel niet bestaat voordat deze wordt aangemaakt
        if (!Schema::hasTable('photos')) {
            Schema::create('photos', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('url');
                $table->timestamps();
            });
        } else {
            // Log of informeer dat de tabel al bestaat
            echo "De 'photos' tabel bestaat al, migratie wordt overgeslagen.\n";
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Alleen de tabel verwijderen als deze bestaat
        if (Schema::hasTable('photos')) {
            Schema::dropIfExists('photos');
        }
    }
}
