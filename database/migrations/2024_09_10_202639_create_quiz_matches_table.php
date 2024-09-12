<?php

use App\MatchType;
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
        Schema::create('quiz_matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('local_team_id')
                ->constrained('teams')
                ->cascadeOnUpdate();
            $table->integer('local_score')->nullable();
            $table->foreignId('guest_team_id')
                ->constrained('teams')
                ->cascadeOnUpdate();
            $table->integer('guest_score')->nullable();
            $table->enum('type', array_column(MatchType::cases(), 'value'))
                ->default(MatchType::REGULAR);
            $table->boolean('downloaded')->default(false);
            $table->primary(['id', 'local_team_id', 'guest_team_id', 'type']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_matches');
    }
};
