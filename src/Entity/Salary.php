<?php

namespace App\Entity;

use App\Enum\PaymentStatus;
use App\Repository\SalaryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalaryRepository::class)]
class Salary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: PaymentStatus::class)]
    private ?PaymentStatus $payment_status = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $paid_date = null;

    #[ORM\Column(length: 255)]
    private ?string $period_month = null;

    #[ORM\Column]
    private int $amount;

    #[ORM\ManyToOne(inversedBy: 'salaries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct(int $amount, User $user)
    {
        $this->amount = $amount;
        $this->user = $user;
        $this->payment_status = PaymentStatus::PENDING;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentStatus(): ?PaymentStatus
    {
        return $this->payment_status;
    }

    public function setPaymentStatus(PaymentStatus $payment_status): static
    {
        $this->payment_status = $payment_status;

        return $this;
    }

    public function getPaidDate(): ?\DateTime
    {
        return $this->paid_date;
    }

    public function setPaidDate(?\DateTime $paid_date): static
    {
        $this->paid_date = $paid_date;

        return $this;
    }

    public function getPeriodMonth(): ?string
    {
        return $this->period_month;
    }

    public function setPeriodMonth(string $period_month): static
    {
        $this->period_month = $period_month;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
