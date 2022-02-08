<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_requests', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('owner_id');
            $table->text('user_message')->nullable();
            $table->text('owner_message')->nullable();

            $table->boolean('is_seen')->default(0);
            $table->unsignedTinyInteger('status')->default(1)->comment("1=>requested, 2=>owner_confirm, 3=>owner_reject, 4=>user_confirm, 5=>user_reject, 6=>return, 7=>return_confirm");

            $table->dateTime('owner_confirm_time')->nullable();
            $table->dateTime('owner_reject_time')->nullable();
            $table->dateTime('user_confirm_time')->nullable();
            $table->dateTime('user_reject_time')->nullable();
            $table->dateTime('return_time')->nullable();
            $table->dateTime('return_confirm_time')->nullable();

            $table->timestamps();
            // $table->id();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_requests');
    }
}
