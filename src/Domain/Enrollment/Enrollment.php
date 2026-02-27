<?php

namespace App\Domain\Enrollment;

use App\Domain\Student\Student;
use App\Domain\Course\Course;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'enrollments')]
#[ORM\UniqueConstraint(name: 'unique_enrollment', columns: ['student_id', 'course_id'])]
class Enrollment
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\ManyToOne(targetEntity: Student::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Student $student;

    #[ORM\ManyToOne(targetEntity: Course::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Course $course;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $enrolledAt;

    private function __construct(EnrollmentId $id, Student $student, Course $course)
    {
        $this->id = $id->value();
        $this->student = $student;
        $this->course = $course;
        $this->enrolledAt = new \DateTimeImmutable();
    }

    /**
     * Factory method with business rule validation
     */
    public static function enroll(Student $student, Course $course): self
    {
        // Business rule: A student can be enrolled (we could add more rules here)
        return new self(EnrollmentId::generate(), $student, $course);
    }

    public function id(): EnrollmentId
    {
        return new EnrollmentId($this->id);
    }

    public function student(): Student
    {
        return $this->student;
    }

    public function course(): Course
    {
        return $this->course;
    }

    public function enrolledAt(): \DateTimeImmutable
    {
        return $this->enrolledAt;
    }
}
