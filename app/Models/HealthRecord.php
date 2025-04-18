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
        'record_date'
    ];

    protected $casts = [
        'record_date' => 'date',
    ];

    /**
     * Get the user that owns the health record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the measurements for the health record.
     */
    public function measurements()
    {
        return $this->hasMany(Measurement::class);
    }

    /**
     * Get the files for the health record.
     */
    public function files()
    {
        return $this->hasMany(HealthRecordFile::class);
    }
}
