<?php

namespace App\Entity;

use App\Enum\ClientStatus;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column]
    private int $pib;

    #[ORM\Column]
    private int $mbr;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $services_price = null;

    #[ORM\Column(enumType: ClientStatus::class)]
    private ClientStatus $status;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    private ?User $dedicated_employee = null;

    /**
     * @var Collection<int, Invoice>
     */
    #[ORM\OneToMany(targetEntity: Invoice::class, mappedBy: 'client')]
    private Collection $invoices;

    public function __construct(string $name, int $pib, int $mbr, ClientStatus $status)
    {
        $this->invoices = new ArrayCollection();
        $this->name = $name;
        $this->pib = $pib;
        $this->mbr = $mbr;
        $this->status = $status;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPib(): int
    {
        return $this->pib;
    }

    public function setPib(int $pib): static
    {
        $this->pib = $pib;

        return $this;
    }

    public function getMbr(): int
    {
        return $this->mbr;
    }

    public function setMbr(int $mbr): static
    {
        $this->mbr = $mbr;

        return $this;
    }

    public function getServicesPrice(): ?string
    {
        return $this->services_price;
    }

    public function setServicesPrice(string $services_price): static
    {
        $this->services_price = $services_price;

        return $this;
    }

    public function getStatus(): ClientStatus
    {
        return $this->status;
    }

    public function setStatus(ClientStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getDedicatedEmployee(): ?User
    {
        return $this->dedicated_employee;
    }

    public function setDedicatedEmployee(?User $dedicated_employee): static
    {
        $this->dedicated_employee = $dedicated_employee;

        return $this;
    }

    /**
     * @return Collection<int, Invoice>
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoice $invoice): static
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices->add($invoice);
            $invoice->setClient($this);
        }

        return $this;
    }

    // removeInvoice is intentionally removed.
    // To remove an invoice, you should delete the Invoice entity
    // or reassign it via $invoice->setClient($newClient).
}
