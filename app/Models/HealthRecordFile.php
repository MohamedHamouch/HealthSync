<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\HealthRecordFileType;

class HealthRecordFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_record_id',
        'filename',
        'path',
        'mime_type',
        'size',
        'description',
        'type'
    ];

    protected $casts = [
        'type' => HealthRecordFileType::class,
    ];

    /**
     * Get the health record that owns the file.
     */
    public function healthRecord()
    {
        return $this->belongsTo(HealthRecord::class);
    }
}
