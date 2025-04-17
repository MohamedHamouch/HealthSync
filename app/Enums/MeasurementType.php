<?php

namespace App\Enums;

enum MeasurementType: string
{
    case BLOOD_PRESSURE = 'BLOOD_PRESSURE';
    case RESPIRATION_RATE = 'RESPIRATION_RATE';
    case BLOOD_SUGAR = 'BLOOD_SUGAR';
    case PULSE_RATE = 'PULSE_RATE';
    case TEMPERATURE = 'TEMPERATURE';
    case WEIGHT = 'WEIGHT';
    case OXYGEN_SATURATION = 'OXYGEN_SATURATION';
} 