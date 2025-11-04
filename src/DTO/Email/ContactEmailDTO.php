<?php

namespace App\DTO\Email;

use Symfony\Component\Validator\Constraints as Assert;

class ContactEmailDTO
{
    #[Assert\NotBlank(message: 'Predmet mejla je obavezan.')]
    #[Assert\Length(
        min: 5,
        max: 100,
        minMessage: 'Obavezno je uneti predmet mejla od bar 5 karaktera.',
        maxMessage: 'Predmet mejla ne može biti duži od 100 karaktera.'
    )]
    private string $subject;

    #[Assert\NotBlank(message: 'Tekst mejla je obavezan.')]
    #[Assert\Length(
        min: 10,
        max: 1000,
        minMessage: 'Obavezno je uneti tekst mejla od bar 10 karaktera.',
        maxMessage: 'Tekst mejla ne može biti duži od 1000 karaktera.'
    )]
    private string $text;

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

}
