<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_equipments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_user')->unsigned();
            $table->string('phone_number',20);
            $table->string('num_room',5);
            $table->date('date_in');
            $table->date('date_repair');
            $table->time('time_repair');
            $table->enum('live', ['0', '1'])->default(0);;
            $table->string('note',300)->default(0);

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
        Schema::drop('repair_equipments');
    }
}
