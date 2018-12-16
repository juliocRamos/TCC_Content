<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professores', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->integer('id_disciplina')->unsigned();
            $table->string('nome', 100);
            $table->string('email',50);
            $table->integer('idade')->unsigned();
            $table->string('sexo', 15);
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
        Schema::dropIfExists('professres');
    }
}
