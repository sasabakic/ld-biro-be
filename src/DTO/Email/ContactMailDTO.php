<?php

namespace App\DTO\Email;

use App\Enum\BusinessType;
use Symfony\Component\Validator\Constraints as Assert;

class ContactMailDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 2)]
    private string $name;

    #[Assert\NotBlank]
    #[Assert\Email]
    private string $contactEmail;

    #[Assert\NotBlank]
    #[Assert\Type(BusinessType::class)]
    private BusinessType $businessType;

    #[Assert\NotBlank]
    #[Assert\Length(min: 10)]
    private string $emailBody;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getContactEmail(): string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(string $contactEmail): void
    {
        $this->contactEmail = $contactEmail;
    }

    public function getBusinessType(): BusinessType
    {
        return $this->businessType;
    }

    public function setBusinessType(BusinessType $businessType): void
    {
        $this->businessType = $businessType;
    }

    public function getEmailBody(): string
    {
        return $this->emailBody;
    }

    public function setEmailBody(string $emailBody): void
    {
        $this->emailBody = $emailBody;
    }
}
