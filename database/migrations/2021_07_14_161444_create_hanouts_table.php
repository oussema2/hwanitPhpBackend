<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHanoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hanouts', function (Blueprint $table) {
            $table->string("_id" , 50)->primary(); 
            $table->string("nom");
          
            $table->string("adress");
            $table->string("imageHAnout");
            $table->string('id_idOwner',50);
           
            $table->unsignedBigInteger('id_typehanouts');
            $table->foreign('id_typehanouts')->references('id')->on('type_hanouts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_idOwner')->references('_id ')->on('users')->onDelete('cascade')->onUpdate('cascade'); 
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
        Schema::dropIfExists('hanouts');
    }
}
