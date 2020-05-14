<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerClubRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_club_request', function (Blueprint $table) {
            $table->integer('player_id');
            $table->integer('club_id');
            $table->boolean('club')->nullable();
            $table->primary(['player_id', 'club_id']);
           // $table->timestamps('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_club_request');
    }
}
