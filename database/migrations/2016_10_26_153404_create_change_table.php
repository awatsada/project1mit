<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_equipmentdetail')->unsigned();
            $table->foreign('id_equipmentdetail')->references('id')->on('equipment_details')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_finish_repair');
            $table->date('date_depart_equipment');
            $table->string('detail_repair',500);
            $table->string('detail_use_equipment',500);
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
        Schema::drop('changes');
    }
}
