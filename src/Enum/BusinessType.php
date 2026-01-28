<?php

namespace App\Enum;

enum BusinessType:string
{
    case ENTREPRENEUR = 'entrepreneur';
    case LLC = 'llc';
    case JSC = 'jsc';
    case FARM = 'farm';
    case PARTNERSHIP = 'partnership';
    case LIMITED_PARTNERSHIP = 'limitedPartnership';
    case COOPERATIVE = 'cooperative';
    case PUBLIC_ENTERPRISE = 'publicEnterprise';
    case INSTITUTION = 'institution';
    case OTHER = 'other';
}
