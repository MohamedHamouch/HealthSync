<?php

namespace App\Enums;

enum HealthRecordFileType: string
{
    case LAB_RESULT = 'lab_result';
    case PRESCRIPTION = 'prescription';
    case X_RAY = 'x_ray';
    case MRI = 'mri';
    case CT_SCAN = 'ct_scan';
    case ULTRASOUND = 'ultrasound';
    case DOCTOR_NOTE = 'doctor_note';
    case INSURANCE = 'insurance';
    case OTHER = 'other';
} 