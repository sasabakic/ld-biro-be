<?php

namespace App\Entity;

use App\Enum\EquipmentCategory;
use App\Enum\EquipmentStatus;
use App\Repository\EquipmentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $entry_date = null;

    #[ORM\Column(enumType: EquipmentStatus::class)]
    private ?EquipmentStatus $status = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $assigned_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $returned_date = null;

    #[ORM\Column(enumType: EquipmentCategory::class)]
    private EquipmentCategory $entity_category;

    #[ORM\ManyToOne(inversedBy: 'equipment')]
    private ?User $employee = null;

    public function __construct(string $name, EquipmentCategory $entity_category)
    {
        $this->name = $name;
        $this->entity_category = $entity_category;
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

    public function getEntryDate(): ?\DateTime
    {
        return $this->entry_date;
    }

    public function setEntryDate(\DateTime $entry_date): static
    {
        $this->entry_date = $entry_date;

        return $this;
    }

    public function getStatus(): ?EquipmentStatus
    {
        return $this->status;
    }

    public function setStatus(EquipmentStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAssignedDate(): ?\DateTime
    {
        return $this->assigned_date;
    }

    public function setAssignedDate(?\DateTime $assigned_date): static
    {
        $this->assigned_date = $assigned_date;

        return $this;
    }

    public function getReturnedDate(): ?\DateTime
    {
        return $this->returned_date;
    }

    public function setReturnedDate(?\DateTime $returned_date): static
    {
        $this->returned_date = $returned_date;

        return $this;
    }

    public function getEntityCategory(): EquipmentCategory
    {
        return $this->entity_category;
    }

    public function setEntityCategory(EquipmentCategory $entity_category): static
    {
        $this->entity_category = $entity_category;

        return $this;
    }

    public function getEmployee(): ?User
    {
        return $this->employee;
    }

    public function setEmployee(?User $employee): static
    {
        $this->employee = $employee;

        return $this;
    }
}
