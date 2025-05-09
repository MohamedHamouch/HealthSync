<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\HealthRecordFileType;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('health_record_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_record_id')->constrained()->onDelete('cascade');
            $table->string('filename'); // Original file name
            $table->string('path'); // Storage path
            $table->string('mime_type'); // File type
            $table->string('size'); // File size in bytes
            $table->string('description')->nullable(); 
            $table->enum('type', array_column(HealthRecordFileType::cases(), 'value'))->default(HealthRecordFileType::OTHER->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_record_files');
    }
};
