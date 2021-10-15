<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_produits', function (Blueprint $table) {
            $table->string('id_commande',50);
            $table->string('id_produit',50);
            $table->string('id_hanout',50);

            $table->integer('quantitie');

            $table->foreign('id_commande')->references('_id ')->on('commandes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_produit')->references('_id')->on('produits')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_hanout')->references('_id')->on('hanouts')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('commande_produits');
    }
}
