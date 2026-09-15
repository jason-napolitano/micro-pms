<?php

namespace App\Models\Enums {

    enum MakeReadyStatus: string
    {
        case COMPLETED = 'completed';
        case CANCELLED = 'cancelled';
        case SCHEDULED = 'scheduled';
        case ON_HOLD = 'on_hold';
        case PENDING = 'pending';
    }
}
