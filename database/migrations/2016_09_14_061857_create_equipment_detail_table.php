<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_equipment')->unsigned()->nullable();
            $table->foreign('id_equipment')->references('id_equipment')->on('equipments')->onDelete('cascade')->onUpdate('cascade');
            $table->string('photo_repair',20)->nullable();
            $table->string('equiment',100)->nullable();
            $table->string('detail_equiment',300)->nullable();

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
        Schema::drop('equipment_details');
    }
}
