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
        Schema::create('maintenance_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('quantity')->unsigned();
            $table->decimal('unit_price', 10, 2);

            //?Relaciones(FK)
            $table->foreignId('spare_part_id')->constrained('spare_parts')
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
        Schema::dropIfExists('maintenance_details');
    }
};
