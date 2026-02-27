<?php

namespace Tests\Domain;

use App\Domain\Enrollment\Enrollment;
use App\Domain\Student\Student;
use App\Domain\Student\StudentId;
use App\Domain\Course\Course;
use App\Domain\Course\CourseId;
use PHPUnit\Framework\TestCase;

final class EnrollmentTest extends TestCase
{
    public function test_enrollment_can_be_created_via_factory(): void
    {
        $student = new Student(new StudentId('s-1'), 'Clara', 'clara@escola.cat');
        $course  = new Course(new CourseId('c-1'), 'SMX', 'Sistemes Microinformàtics', 2024);

        $enrollment = Enrollment::enroll($student, $course);

        $this->assertSame($student, $enrollment->student());
        $this->assertSame($course, $enrollment->course());
        $this->assertNotEmpty($enrollment->id()->__toString());
    }

    public function test_enrollment_records_date(): void
    {
        $before     = new \DateTimeImmutable();
        $student    = new Student(new StudentId('s-1'), 'Pau', 'pau@escola.cat');
        $course     = new Course(new CourseId('c-1'), 'ASIX', 'Administració de Sistemes', 2024);
        $enrollment = Enrollment::enroll($student, $course);
        $after      = new \DateTimeImmutable();

        $this->assertGreaterThanOrEqual($before, $enrollment->enrolledAt());
        $this->assertLessThanOrEqual($after, $enrollment->enrolledAt());
    }
}
