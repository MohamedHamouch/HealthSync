<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'record_date',
        'blood_pressure_systolic',
        'blood_pressure_diastolic',
        'respiration_rate',
        'blood_sugar',
        'pulse_rate',
        'temperature',
        'weight',
        'oxygen_saturation'
    ];

    protected $casts = [
        'record_date' => 'date',
        'blood_pressure_systolic' => 'float',
        'blood_pressure_diastolic' => 'float',
        'respiration_rate' => 'float',
        'blood_sugar' => 'float',
        'pulse_rate' => 'float',
        'temperature' => 'float',
        'weight' => 'float',
        'oxygen_saturation' => 'float',
    ];

    /**
     * Get the user that owns the health record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the files for the health record.
     */
    public function files()
    {
        return $this->hasMany(HealthRecordFile::class);
    }

    /**
     * Get the array of measurement units for display
     */
    public static function getMeasurementUnits(): array
    {
        return [
            'blood_pressure_systolic' => 'mmHg',
            'blood_pressure_diastolic' => 'mmHg',
            'respiration_rate' => 'breaths/min',
            'blood_sugar' => 'mg/dL',
            'pulse_rate' => 'bpm',
            'temperature' => '°C',
            'weight' => 'kg',
            'oxygen_saturation' => '%',
        ];
    }
}
