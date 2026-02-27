<?php

namespace App\Domain\Student;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'students')]
class Student
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string', unique: true)]
    private string $email;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct(StudentId $id, string $name, string $email)
    {
        $this->guardNameIsNotEmpty($name);
        $this->guardEmailIsValid($email);

        $this->id        = $id->value();
        $this->name      = $name;
        $this->email     = $email;
        $this->createdAt = new \DateTimeImmutable();
    }

    private function guardNameIsNotEmpty(string $name): void
    {
        if (trim($name) === '') {
            throw new \InvalidArgumentException('El nom de l\'alumne no pot estar buit.');
        }
    }

    private function guardEmailIsValid(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("L'email '{$email}' no és vàlid.");
        }
    }

    public function id(): StudentId { return new StudentId($this->id); }
    public function name(): string { return $this->name; }
    public function email(): string { return $this->email; }
    public function createdAt(): \DateTimeImmutable { return $this->createdAt; }
}
