<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangeEquipmentdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_equipmentdetails', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_changeequipment')->unsigned();
            $table->foreign('id_changeequipment')->references('id')->on('change_equipments')->onDelete('cascade')->onUpdate('cascade');
            $table->string('photo_repair',20)->nullable();
            $table->string('equiment',100);
            $table->string('detail_equiment',300);

            $table->integer('id_usersaverepair')->unsigned();
            $table->foreign('id_usersaverepair')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_finish_repair');
            $table->date('date_depart_equipment');
            $table->string('detail_repair',500);
            $table->string('detail_use_equipment',500);
            $table->integer('number')->default(0);
            $table->string('name_technical',500);
            $table->string('name_technical_depart',500);

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
        Schema::drop('change_equipmentdetails');
    }
}
