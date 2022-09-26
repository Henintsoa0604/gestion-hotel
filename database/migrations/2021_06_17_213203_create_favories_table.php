<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_ch')->unique();
            $table->string('num_tel_ch')->nullable();
            $table->text('description_ch');
            $table->integer('nbr_lit_ch');
            $table->integer('nbr_pers');
            $table->string('etage_ch');
            $table->string('status_ch');
            $table->integer('categorie_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('favories');
    }
}
