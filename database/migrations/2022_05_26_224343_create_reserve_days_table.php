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
        Schema::create('reserve_days', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_id', 7)->references('reservation_id')->on('reservations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedTinyInteger('room_id');
            $table->date('day');
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
        Schema::dropIfExists('reserve_days');
    }
};
