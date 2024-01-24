<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Email;
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
    protected string $email;
    
    #[Assert\NotBlank]
    #[Assert\Type(Email::class)]
    protected string $phone;

    #[Assert\NotBlank]
    #[Assert\Type(DateTimeInterface::class)]
    protected DateTimeInterface $start;
    

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

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
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

    public function getStart(): DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(DateTimeInterface $dueDate): void
    {
        $this->start = $dueDate;
    }
}
