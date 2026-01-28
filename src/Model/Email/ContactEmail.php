<?php

namespace App\Model\Email;

use App\Enum\BusinessType;

class ContactEmail
{
    public string $name;
    public string $contactEmail;
    public BusinessType $businessType;
    public string $emailBody;
}
