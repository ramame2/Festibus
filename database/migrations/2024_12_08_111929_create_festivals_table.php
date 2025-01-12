<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivalsTable extends Migration
{
    public function up()
    {
        Schema::create('festivals', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->date('datum');
            $table->text('beschrijving');
            $table->string('image');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('festivals');
    }
}
