<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notis', function (Blueprint $table) {
            $table->id();
            $table->string('NameSurname',100)->nullable();
            $table->date('ComeDate')->nullable(); //gelen tarih 
            $table->string('WhereFrom',100)->nullable(); //nereden geldi
            $table->string('WhoTook',100)->nullable(); // kim teslim aldi
            $table->date('DeliverDate')->nullable(); //teslim tarih 
            //ekstra adet
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
        Schema::dropIfExists('notis');
    }
}
