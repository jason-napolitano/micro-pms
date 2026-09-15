<?php

namespace App\Models\Enums {

    enum MakeReadyStatus: string
    {
        case PENDING = 'pending';

        case SCHEDULED = 'scheduled';

        case ON_HOLD = 'on_hold';

        case COMPLETED = 'completed';

        case CANCELLED = 'cancelled';
    }
}
