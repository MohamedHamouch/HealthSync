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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_record_id')->constrained()->onDelete('cascade');
            $table->enum('type', [
                'BLOOD_PRESSURE',
                'RESPIRATION_RATE',
                'BLOOD_SUGAR',
                'PULSE_RATE',
                'TEMPERATURE',
                'WEIGHT',
                'OXYGEN_SATURATION'
            ]);
            $table->float('value');
            $table->string('unit');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
