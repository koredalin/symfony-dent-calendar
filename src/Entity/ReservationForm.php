<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Email;

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
}
