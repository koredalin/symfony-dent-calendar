<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\DateTime;
use DateTimeInterface;

/**
 * Description of ReservationForm
 *
 * @author user
 */
class ReservationForm
{
    #[Assert\NotBlank]
    protected string $name;
    
    #[Assert\NotBlank]
    #[Assert\Email()]
    protected ?string $email;
    
    #[Assert\NotBlank]
    protected string $phone;

    /**
     * @var string A "Y-m-d H:i:s" formatted value
     */
//    #[Assert\NotBlank]
    #[Assert\Type(DateTimeInterface::class)]
    protected ?DateTimeInterface $startAt;
    

    public function get(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setStartAt(?DateTimeInterface $startAt): void
    {
        $this->startAt = $startAt;
    }

    public function getStartAt(): ?DateTimeInterface
    {
        return $this->startAt;
    }
}
