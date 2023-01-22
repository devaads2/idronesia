<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('id_projects');
            $table->integer('id_checklist');
            $table->integer('id_manager');
            $table->integer('id_pilot');
            $table->integer('id_drone');
            $table->integer('id_batteries');
            $table->integer('id_equipments');
            $table->integer('id_kits');
            $table->date('start_date');
            $table->date('until_date');
            $table->string('mission_flight');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('status_project');
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
        Schema::dropIfExists('projects');
    }
}
