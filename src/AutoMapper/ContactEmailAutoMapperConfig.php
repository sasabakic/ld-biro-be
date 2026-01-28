<?php

namespace App\AutoMapper;

use App\DTO\Email\ContactMailDTO;
use App\Model\Email\ContactEmail;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class ContactEmailAutoMapperConfig implements AutoMapperConfiguratorInterface
{

    public function configure(AutoMapperConfigInterface $config): void
    {
        $config->registerMapping(ContactMailDTO::class, ContactEmail::class);
    }
}
