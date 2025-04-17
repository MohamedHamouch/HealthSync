<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
