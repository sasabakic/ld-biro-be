<?php

namespace App\Entity;

use App\Enum\PaymentStatus;
use App\Repository\InvoiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column(enumType: PaymentStatus::class)]
    private ?PaymentStatus $payment_status = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $period_start = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $period_end = null;

    #[ORM\ManyToOne(inversedBy: 'issued_invoices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $issuer = null;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
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

    public function getPeriodStart(): ?\DateTime
    {
        return $this->period_start;
    }

    public function setPeriodStart(\DateTime $period_start): static
    {
        $this->period_start = $period_start;

        return $this;
    }

    public function getPeriodEnd(): ?\DateTime
    {
        return $this->period_end;
    }

    public function setPeriodEnd(\DateTime $period_end): static
    {
        $this->period_end = $period_end;

        return $this;
    }

    public function getIssuer(): ?User
    {
        return $this->issuer;
    }

    public function setIssuer(?User $issuer): static
    {
        $this->issuer = $issuer;

        return $this;
    }

    public function getClientId(): ?Client
    {
        return $this->client_id;
    }

    public function setClientId(?Client $client_id): static
    {
        $this->client_id = $client_id;

        return $this;
    }
}
