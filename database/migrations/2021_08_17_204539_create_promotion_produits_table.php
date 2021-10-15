<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_produits', function (Blueprint $table) {
            $table->string('id_Produit' , 50);
            $table->unsignedBigInteger('id_Promotion');
            $table->foreign('id_Produit')->references('_id')->on('produits')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_Promotion')->references('id')->on('promotions')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('promotion_produits');
    }
}
