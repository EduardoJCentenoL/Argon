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
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150);

            //? Claves Foraneas / Relaciones
            $table->foreignId('brand_id')->constrained('brands')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();

            //? REGLA EN BD: Evita el mismo nombre de modelo repetido en la misma marca
            $table->unique(['name', 'brand_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_models');
    }
};
