<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->string('_id',50)->primary();
            $table->string('numTelDestinataire');
            $table->string('addressDestinataire');
            $table->integer("productNumber");
            $table->date('dateCommande');
            $table->float('total');
            $table->string('id_user' , 50);
            $table->boolean('delivredTransporteur');

            $table->foreign('id_user')->references('_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('commandes');
    }
}
