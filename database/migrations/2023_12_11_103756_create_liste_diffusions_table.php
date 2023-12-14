<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListeDiffusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liste_diffusions', function (Blueprint $table) {
            $table->id();
            $table->string('date_diffusion');
            $table->string('title')->nullable();
            $table->unsignedBigInteger('categorie_programme_tv_id');
            $table->unsignedBigInteger('programme_tv_id');

            $table->foreign('categorie_programme_tv_id')->references('id')
                ->on('categorie_programme_tvs')
                ->onDelete('cascade');

            $table->foreign('programme_tv_id')->references('id')
                ->on('programme_tvs')
                ->onDelete('cascade');

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
        Schema::dropIfExists('liste_diffusions');
    }
}
