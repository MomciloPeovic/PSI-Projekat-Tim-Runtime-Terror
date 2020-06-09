<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubPlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_player', function (Blueprint $table) {
            $table->foreignId('club_id')->constrained('clubs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade')->onUpdate('cascade');
            $table->date('joined')->nullable();
            $table->date('left')->nullable();
            $table->primary(['club_id', 'player_id','joined']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club_player');
    }
}
