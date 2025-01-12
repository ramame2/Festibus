<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('departure');
            $table->string('destination');
            $table->date('departure_date')->nullable();
            $table->time('departure_time');
            $table->decimal('price', 8, 2);
            $table->integer('number_of_people');
            $table->decimal('total_price', 8, 2);
            $table->string('payment_method');
            $table->string('email');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
