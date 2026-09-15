<?php

namespace App\Models\Enums {

    enum MakeReadyPriority: string
    {
        case LOW = 'low';

        case NORMAL = 'normal';

        case HIGH = 'high';

        case URGENT = 'urgent';
    }
}
