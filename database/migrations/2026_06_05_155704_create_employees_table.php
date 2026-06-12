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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->char('gender', 2);
            $table->integer('age');
            $table->string('doc_number', 16);
            $table->string('email_address', 150);
            $table->boolean('is_active')->default(true);

            //? Relaciones(FK)
            $table->foreignId('specialty_id')->constrained('specialties')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('shift_id')->constrained('shifts')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('role_id')->constrained('roles')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
