<?php

namespace App\Enums;

enum AppointmentStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    
    /**
     * Get the human-readable label for the status.
     */
    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::CONFIRMED => 'Confirmed',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }
    
    /**
     * Get the Tailwind color name for the status.
     */
    public function color(): string
    {
        return match($this) {
            self::PENDING => 'yellow',
            self::CONFIRMED => 'blue',
            self::COMPLETED => 'green',
            self::CANCELLED => 'red',
        };
    }
} 