<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $systemDB = config('database.connections.mysqlsystem.database');

            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('Pk_Usuario_Login')
                ->on(new Expression("$systemDB.Tbl_Usuario_Login"))
                ->cascadeOnUpdate();
            /* $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate(); */
            $table->foreignId('role_id')
                ->constrained()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
