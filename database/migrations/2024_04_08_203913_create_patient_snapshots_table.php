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
        Schema::create('patient_snapshots', function (Blueprint $table) {
            $serviciosDB = config('database.connections.mysqlservicios.database');
            $catalogosDB = config('database.connections.mysqlcatalogos.database');

            $table->id();
            $table->string('CURP', 18);
            $table->string('RFC', 12);
            $table->string('homonimia', 3);
            $table->integer('link');
            $table->integer('kinship');
            $table->enum('status', ['A', 'S', 'B', 'H', 'T', 'P'])->comment('A: Activo, S: Suspendido, B: Baja, H: Histórico, T: Temporal, P: Preafiliación');
            $table->string('name', 60);
            $table->string('paternal_surname', 60);
            $table->string('maternal_surname', 60);
            $table->string('sector', 40);
            $table->enum('gender', ['F', 'M', '0']);
            $table->date('birth_date');
            $table->string('address', 200);
            $table->string('residence_municipality');
            $table->string('residence_state');
            $table->mediumInteger('coordination');
            $table->string('telephone', 20);
            $table->string('cellphone', 20);
            $table->string('marital_status', 15);
            $table->integer('postal_code');
            /* To fill at tertiary healthcare level */
            $table->string('birth_state')->nullable();
            $table->string('birth_municipality')->nullable();
            /* ------------------------------------ */
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')
                ->references('Pk_PadronMaestro')
                ->on(new Expression("$serviciosDB.Tbl_Padron_Maestro"))
                ->cascadeOnUpdate();
            $table->smallInteger('adscription_id')->unsigned();
            $table->foreign('adscription_id')
                ->references('Pk_Adscripcion')
                ->on(new Expression("$catalogosDB.Cat_Adscripcion"))
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_snapshots');
    }
};
