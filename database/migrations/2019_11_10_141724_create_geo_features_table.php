<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('geo_object_id')->unsigned();
            $table->float('area');
            $table->geometry('geom');
            $table->timestamps();

            $table->foreign('geo_object_id')->references('id')->on('geo_objects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_features');
    }
}
