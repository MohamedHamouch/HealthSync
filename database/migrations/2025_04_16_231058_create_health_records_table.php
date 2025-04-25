<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('description');
            $table->date('record_date')->nullable();

            // Health data fields
            $table->decimal('blood_pressure_systolic', 5, 2)->nullable();    // mmHg
            $table->decimal('blood_pressure_diastolic', 5, 2)->nullable();   // mmHg
            $table->decimal('respiration_rate', 5, 2)->nullable();           // breaths/min
            $table->decimal('blood_sugar', 6, 2)->nullable();                // mg/dL
            $table->decimal('pulse_rate', 5, 2)->nullable();                 // bpm
            $table->decimal('temperature', 4, 2)->nullable();                // °C
            $table->decimal('weight', 6, 2)->nullable();                     // kg
            $table->decimal('oxygen_saturation', 5, 2)->nullable();          // %

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
