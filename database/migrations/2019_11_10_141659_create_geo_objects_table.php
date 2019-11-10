<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_objects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('geo_type_id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('geo_type_id')->references('id')->on('geo_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_objects');
    }
}
