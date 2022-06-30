<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_id', 7)->unique();
            $table->unsignedTinyInteger('room_id');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('email');
            $table->string('address');
            $table->string('tel');
            $table->string('people');
            $table->string('men');
            $table->string('women');
            $table->string('arrival');
            $table->string('departure');
            $table->string('checkin_time');
            $table->string('totalprice');
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
        Schema::dropIfExists('reservations');
    }
};
