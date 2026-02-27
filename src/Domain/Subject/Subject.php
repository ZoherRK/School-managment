<?php

namespace App\Domain\Subject;

use App\Domain\Course\Course;
use App\Domain\Teacher\Teacher;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'subjects')]
class Subject
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'integer')]
    private int $credits;

    #[ORM\ManyToOne(targetEntity: Course::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Course $course;

    #[ORM\ManyToOne(targetEntity: Teacher::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Teacher $teacher = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct(SubjectId $id, string $name, int $credits, Course $course)
    {
        $this->guardNameIsNotEmpty($name);
        $this->guardCreditsAreValid($credits);

        $this->id        = $id->value();
        $this->name      = $name;
        $this->credits   = $credits;
        $this->course    = $course;
        $this->createdAt = new \DateTimeImmutable();
    }

    private function guardNameIsNotEmpty(string $name): void
    {
        if (trim($name) === '') {
            throw new \InvalidArgumentException('El nom de l\'assignatura no pot estar buit.');
        }
    }

    private function guardCreditsAreValid(int $credits): void
    {
        if ($credits < 1 || $credits > 12) {
            throw new \InvalidArgumentException("Els crèdits '{$credits}' no són vàlids. Han de ser entre 1 i 12.");
        }
    }

    public function assignTeacher(Teacher $teacher): void
    {
        $this->teacher = $teacher;
    }

    public function id(): SubjectId { return new SubjectId($this->id); }
    public function name(): string { return $this->name; }
    public function credits(): int { return $this->credits; }
    public function course(): Course { return $this->course; }
    public function teacher(): ?Teacher { return $this->teacher; }
    public function createdAt(): \DateTimeImmutable { return $this->createdAt; }
}
