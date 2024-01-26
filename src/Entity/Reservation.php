<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;
use App\Entity\User;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[Broadcast]
class Reservation
{
    public const SET_USER_METHOD_BASE_STR = 'setUserAt';
    public const GET_USER_METHOD_BASE_STR = 'getUserAt';
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::DATE_MUTABLE, unique: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(name: "user_id_at_9", nullable: true, referencedColumnName: "id")]
    private ?User $userAt9 = null;

    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(name: "user_id_at_10", nullable: true, referencedColumnName: "id")]
    private ?User $userAt10 = null;

    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(name: "user_id_at_11", nullable: true, referencedColumnName: "id")]
    private ?User $userAt11 = null;

    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(name: "user_id_at_12", nullable: true, referencedColumnName: "id")]
    private ?User $userAt12 = null;

    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(name: "user_id_at_13", nullable: true, referencedColumnName: "id")]
    private ?User $userAt13 = null;

    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(name: "user_id_at_14", nullable: true, referencedColumnName: "id")]
    private ?User $userAt14 = null;

    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(name: "user_id_at_15", nullable: true, referencedColumnName: "id")]
    private ?User $userAt15 = null;

    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(name: "user_id_at_16", nullable: true, referencedColumnName: "id")]
    private ?User $userAt16 = null;

    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(name: "user_id_at_17", nullable: true, referencedColumnName: "id")]
    private ?User $userAt17 = null;

    
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

    public function getUserAt9(): ?User
    {
        return $this->userAt9;
    }

    public function setUserAt9(?User $userAt9): static
    {
        $this->userAt9 = $userAt9;

        return $this;
    }

    public function getUserAt10(): ?User
    {
        return $this->userAt10;
    }

    public function setUserAt10(?User $userAt10): static
    {
        $this->userAt10 = $userAt10;

        return $this;
    }

    public function getUserAt11(): ?User
    {
        return $this->userAt11;
    }

    public function setUserAt11(?User $userAt11): static
    {
        $this->userAt11 = $userAt11;

        return $this;
    }

    public function getUserAt12(): ?User
    {
        return $this->userAt12;
    }

    public function setUserAt12(?User $userAt12): static
    {
        $this->userAt12 = $userAt12;

        return $this;
    }

    public function getUserAt13(): ?User
    {
        return $this->userAt13;
    }

    public function setUserAt13(?User $userAt13): static
    {
        $this->userAt13 = $userAt13;

        return $this;
    }

    public function getUserAt14(): ?User
    {
        return $this->userAt14;
    }

    public function setUserAt14(?User $userAt14): static
    {
        $this->userAt14 = $userAt14;

        return $this;
    }

    public function getUserAt15(): ?User
    {
        return $this->userAt15;
    }

    public function setUserAt15(?User $userAt15): static
    {
        $this->userAt15 = $userAt15;

        return $this;
    }

    public function getUserAt16(): ?User
    {
        return $this->userAt16;
    }

    public function setUserAt16(?User $userAt16): static
    {
        $this->userAt16 = $userAt16;

        return $this;
    }

    public function getUserAt17(): ?User
    {
        return $this->userAt17;
    }

    public function setUserAt17(?User $userAt17): static
    {
        $this->userAt17 = $userAt17;

        return $this;
    }
}
