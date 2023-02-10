<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDronesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drones', function (Blueprint $table) {
            $table->id();
            $table->string('drone_name');
            $table->string('max_flying_alt');
            $table->string('adjustable_angel_camera');
            $table->string('eis');
            $table->string('control_distance');
            $table->string('wifi_transmission');
            $table->string('video_res');
            $table->string('photo_res');
            $table->string('product_weight');
            $table->string('image')->default('drone.jpg');
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
        Schema::dropIfExists('drones');
    }
}
