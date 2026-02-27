<?php

namespace App\Domain\Teacher;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'teachers')]
class Teacher
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string', unique: true)]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $specialty;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct(TeacherId $id, string $name, string $email, string $specialty)
    {
        $this->guardNameIsNotEmpty($name);
        $this->guardEmailIsValid($email);
        $this->guardSpecialtyIsNotEmpty($specialty);

        $this->id        = $id->value();
        $this->name      = $name;
        $this->email     = $email;
        $this->specialty = $specialty;
        $this->createdAt = new \DateTimeImmutable();
    }

    private function guardNameIsNotEmpty(string $name): void
    {
        if (trim($name) === '') {
            throw new \InvalidArgumentException('El nom del professor no pot estar buit.');
        }
    }

    private function guardEmailIsValid(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("L'email '{$email}' no és vàlid.");
        }
    }

    private function guardSpecialtyIsNotEmpty(string $specialty): void
    {
        if (trim($specialty) === '') {
            throw new \InvalidArgumentException('L\'especialitat del professor no pot estar buida.');
        }
    }

    public function id(): TeacherId { return new TeacherId($this->id); }
    public function name(): string { return $this->name; }
    public function email(): string { return $this->email; }
    public function specialty(): string { return $this->specialty; }
    public function createdAt(): \DateTimeImmutable { return $this->createdAt; }
}
