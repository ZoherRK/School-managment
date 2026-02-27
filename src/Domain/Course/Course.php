<?php

namespace App\Domain\Course;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'courses')]
class Course
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $description;

    #[ORM\Column(type: 'integer')]
    private int $year;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct(CourseId $id, string $name, string $description, int $year)
    {
        $this->guardNameIsNotEmpty($name);
        $this->guardYearIsValid($year);

        $this->id          = $id->value();
        $this->name        = $name;
        $this->description = $description;
        $this->year        = $year;
        $this->createdAt   = new \DateTimeImmutable();
    }

    private function guardNameIsNotEmpty(string $name): void
    {
        if (trim($name) === '') {
            throw new \InvalidArgumentException('El nom del curs no pot estar buit.');
        }
    }

    private function guardYearIsValid(int $year): void
    {
        if ($year < 2000 || $year > 2100) {
            throw new \InvalidArgumentException("L'any '{$year}' no és vàlid. Ha de ser entre 2000 i 2100.");
        }
    }

    public function id(): CourseId { return new CourseId($this->id); }
    public function name(): string { return $this->name; }
    public function description(): string { return $this->description; }
    public function year(): int { return $this->year; }
    public function createdAt(): \DateTimeImmutable { return $this->createdAt; }
}
