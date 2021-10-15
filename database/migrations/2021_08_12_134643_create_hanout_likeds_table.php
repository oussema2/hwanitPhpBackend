<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHanoutLikedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hanout_likeds', function (Blueprint $table) {
            $table->id();
            $table->string("idHanout",50);
            $table->string("idUser",50);


            $table->timestamps();

            $table->foreign('idHanout')->references('_id')->on('hanouts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idUser')->references('_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hanout_likeds');
    }
}
