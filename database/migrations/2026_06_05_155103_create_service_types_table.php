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
        Schema::create('service_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique();
            $table->string('service_description', 255)->nullable()->default('SIN DESCRIPCION');
            $table->timestamps();
        });

        //Aplicar CHECK constraint con SQL nativo
        DB::statement('ALTER TABLE service_types ADD CONSTRAINT chk_service_type_name
        CHECK (name IN ("Preventivo", "Correctivo"))'   );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('service_types')) {
            DB::statement('ALTER TABLE service_types DROP CHECK chk_service_type_name');
        }

        Schema::dropIfExists('service_types');
    }
};
