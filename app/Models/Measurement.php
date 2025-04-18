<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\MeasurementType;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_record_id',
        'type',
        'value',
        'unit',
        'note'
    ];

    protected $casts = [
        'value' => 'float',
        'type' => MeasurementType::class,
    ];

    /**
     * Get the health record that owns the measurement.
     */
    public function healthRecord()
    {
        return $this->belongsTo(HealthRecord::class);
    }
}
