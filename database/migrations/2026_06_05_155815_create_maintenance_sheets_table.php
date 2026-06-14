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
        Schema::create('maintenance_sheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('entry_date');
            $table->dateTime('estimated_delivery_date');
            $table->integer('current_mileage')->unsigned();
            $table->text('work_execution_details');
            $table->string('sheet_status', 50);

            //? RELACIONES (FK)
            $table->foreignId('vehicle_id')->constrained('vehicles')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('employee_id')->constrained('employees')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('service_type_id')->constrained('service_types')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('failure_id')->constrained('failures')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });

         //? Aplicar CHECK constraint con SQL nativo en lugar de enum
        DB::statement('ALTER TABLE maintenance_sheets ADD CONSTRAINT chk_sheet_status CHECK (sheet_status IN (
        "RECEPCIONADO",
        "DIAGNOSTICO",
        "EN_ESPERA",
        "EN_PROCESO",
        "COMPLETADO",
        "ENTREGADO",
        "RECHAZADO"
        ))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('maintenance_sheets')) {
            DB::statement('ALTER TABLE maintenance_sheets DROP CHECK chk_vehicle_transmission');
        }

        Schema::dropIfExists('maintenance_sheets');
    }
};
