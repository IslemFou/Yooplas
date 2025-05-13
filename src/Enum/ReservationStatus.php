<?php

namespace App\Enum;

enum ReservationStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'accepted';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
    case EXPIRED = 'expired';
}
