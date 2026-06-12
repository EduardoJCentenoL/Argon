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
        Schema::create('service_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetimes('completion_date');
            $table->decimal('labor_cost', 10, 2);
            $table->decimal('spare_parts_cost', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->text('recomendations')->nullable();

            //?RELACIONES
            $table->foreignId('vehicle_id')->constrained('vehicles')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('maintenance_sheet_id')->constrained('maintenance_sheets')
            ->cascadeOnUpdate()->cascadeOnDelete();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_histories');
    }
};
