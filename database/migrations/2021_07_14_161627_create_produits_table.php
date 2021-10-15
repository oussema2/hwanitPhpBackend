<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->string('_id',50)->primary();
            $table->string('nom');
            $table->text('description');
            $table->float('prix');
            $table->unsignedBigInteger('id_categorie');
            $table->unsignedBigInteger('id_brand');
            $table->integer('quantitie');
            $table->string('id_hanout',50);
            $table->string('idInMongo');
 
            $table->text('thumbnail');
            $table->foreign('id_categorie')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_brand')->references('id ')->on('brands')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('produits');
    }
}
