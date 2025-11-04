<?php

namespace App\Enum;

enum ClientStatus:string
{
    case ACTIVE = 'active';
    case CANCELLED = 'cancelled';
    case ON_HOLD = 'on_hold';
}
