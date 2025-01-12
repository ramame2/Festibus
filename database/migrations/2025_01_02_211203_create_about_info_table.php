<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutInfoTable extends Migration
{
    public function up(): void
    {
        // Create the table if it doesn't exist
        if (!Schema::hasTable('about_infos')) {
            Schema::create('about_infos', function (Blueprint $table) {
                $table->id();
                $table->string('phone')->nullable();
                $table->text('location')->nullable();
                $table->text('email')->nullable();
                $table->json('opening_hours')->nullable();
                $table->timestamps();
            });
        } else {
            // If table already exists, alter the table to add columns
            Schema::table('about_infos', function (Blueprint $table) {
                $table->string('phone')->nullable();
                $table->text('location')->nullable();
                $table->text('email')->nullable();
                $table->json('opening_hours')->nullable();
            });
        }
    }

    public function down(): void
    {
        // If the table exists, drop it
        Schema::dropIfExists('about_infos');
    }
}
