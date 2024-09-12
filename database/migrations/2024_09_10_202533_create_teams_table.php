<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('won_matches')->default(0);
            $table->integer('lost_matches')->default(0);
            $table->integer('drawn_matches')->default(0);
            $table->integer('scored_points')->default(0);
            $table->integer('conceded_points')->default(0);
            $table->integer('point_spread')->storedAs('scored_points - conceded_points');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
