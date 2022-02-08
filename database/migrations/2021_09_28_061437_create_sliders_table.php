<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->BigIncrements('id');
            $table->string('title');
            $table->string('image');
            $table->string('link')->nullable();
            $table->string('link_text')->nullable();
            $table->unsignedTinyInteger('priority')->default(1)->comment('Lower=Higher Priority');
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
        Schema::dropIfExists('sliders');
    }
}
