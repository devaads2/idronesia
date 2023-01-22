<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id('id_checklists');
            $table->string('visual')->default('["-"]');
            $table->string('control')->default('["-"]');
            $table->string('propellers')->default('["-"]');
            $table->string('power')->default('["-"]');
            $table->string('payload')->default('["-"]');
            $table->string('monitor')->default('["-"]');
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
        Schema::dropIfExists('checklists');
    }
}
