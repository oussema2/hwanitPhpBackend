<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitLikedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_likeds', function (Blueprint $table) {
            $table->id();
            $table->string("idProduit",50);
            $table->string("idUser",50);


            $table->timestamps();

            $table->foreign('idProduit')->references('_id')->on('produits')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('produit_likeds');
    }
}
