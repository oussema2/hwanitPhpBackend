<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHanoutcommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hanoutcommandes', function (Blueprint $table) {
            $table->id();
            $table->string('idHanout' , 50);
            $table->string('idCommande', 50);
            $table->integer('nombreProduit');
            $table->boolean('delivred');
            

            $table->foreign('idHanout')->references('_id')->on('hanouts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idCommande')->references('_id')->on('commandes')->onDelete('cascade')->onUpdate('cascade');
           
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
        Schema::dropIfExists('hanoutcommandes');
    }
}
