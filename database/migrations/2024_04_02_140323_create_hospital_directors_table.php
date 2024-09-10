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
        Schema::create('hospital_directors', function (Blueprint $table) {
            $catalogosDB = config('database.connections.mysqlcatalogos.database');

            $table->id();
            $table->string('name');
            $table->string('paternal_surname');
            $table->string('maternal_surname');
            $table->string('professional_license', 10);
            $table->bigInteger('doctor_id')->unsigned();
            $table->foreign('doctor_id')
                ->references('Pk_Medico')
                ->on(new Expression("$catalogosDB.Cat_Medico"))
                ->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_directors');
    }
};
