<?php

namespace App\Enum;

enum PaymentStatus:string
{
    case PAID = 'paid';
    case PENDING = 'pending';
    case OVERDUE = 'overdue';
}
