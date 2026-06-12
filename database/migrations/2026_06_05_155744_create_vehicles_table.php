<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('license_plate', 20);
            $table->smallInteger('model_year', 4)->unsigned();
            $table->date('production_date')->nullable();
            $table->string('color', 50);
            $table->string('engine', 100);
            $table->string('transmission', 50);
            $table->text('vehicle_observations')->nullable();

            //? Relaciones (FK)
            $table->foreignId('vehicle_model_id')->constrained('vehicle_model')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('customer_id')->constrained('customers')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });

        //? Aplicar CHECK constraint con SQL nativo en lugar de enum
        DB::statement('ALTER TABLE vehicles ADD CONSTRAINT chk_vehicle_transmission
        CHECK (transmission IN (
        "MANUAL",
        "AUTOMATICA",
        "CONTINUA(CVT)",
        "DOBLE EMBRAGUE(DCT)",
        "AUTOMATIZADA(AMT)",
        "SECUENCIAL",
        "DIRECTA"))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('vehicles')) {
            DB::statement('ALTER TABLE vehicles DROP CHECK chk_vehicle_transmission');
        }

        Schema::dropIfExists('vehicles');
    }
};
