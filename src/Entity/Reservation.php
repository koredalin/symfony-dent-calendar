<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[Broadcast]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::DATE_MUTABLE, unique: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(nullable: true)]
    private ?int $start_at_9 = null;

    #[ORM\Column(nullable: true)]
    private ?int $start_at_10 = null;

    #[ORM\Column(nullable: true)]
    private ?int $start_at_11 = null;

    #[ORM\Column(nullable: true)]
    private ?int $start_at_12 = null;

    #[ORM\Column(nullable: true)]
    private ?int $start_at_13 = null;

    #[ORM\Column(nullable: true)]
    private ?int $start_at_14 = null;

    #[ORM\Column(nullable: true)]
    private ?int $start_at_15 = null;

    #[ORM\Column(nullable: true)]
    private ?int $start_at_16 = null;

    #[ORM\Column(nullable: true)]
    private ?int $start_at_17 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getStartAt9(): ?int
    {
        return $this->start_at_9;
    }

    public function setStartAt9(?int $start_at_9): static
    {
        $this->start_at_9 = $start_at_9;

        return $this;
    }

    public function getStartAt10(): ?int
    {
        return $this->start_at_10;
    }

    public function setStartAt10(?int $start_at_10): static
    {
        $this->start_at_10 = $start_at_10;

        return $this;
    }

    public function getStartAt11(): ?int
    {
        return $this->start_at_11;
    }

    public function setStartAt11(?int $start_at_11): static
    {
        $this->start_at_11 = $start_at_11;

        return $this;
    }

    public function getStartAt12(): ?int
    {
        return $this->start_at_12;
    }

    public function setStartAt12(?int $start_at_12): static
    {
        $this->start_at_12 = $start_at_12;

        return $this;
    }

    public function getStartAt13(): ?int
    {
        return $this->start_at_13;
    }

    public function setStartAt13(?int $start_at_13): static
    {
        $this->start_at_13 = $start_at_13;

        return $this;
    }

    public function getStartAt14(): ?int
    {
        return $this->start_at_14;
    }

    public function setStartAt14(?int $start_at_14): static
    {
        $this->start_at_14 = $start_at_14;

        return $this;
    }

    public function getStartAt15(): ?int
    {
        return $this->start_at_15;
    }

    public function setStartAt15(?int $start_at_15): static
    {
        $this->start_at_15 = $start_at_15;

        return $this;
    }

    public function getStartAt16(): ?int
    {
        return $this->start_at_16;
    }

    public function setStartAt16(?int $start_at_16): static
    {
        $this->start_at_16 = $start_at_16;

        return $this;
    }

    public function getStartAt17(): ?int
    {
        return $this->start_at_17;
    }

    public function setStartAt17(?int $start_at_17): static
    {
        $this->start_at_17 = $start_at_17;

        return $this;
    }
}
