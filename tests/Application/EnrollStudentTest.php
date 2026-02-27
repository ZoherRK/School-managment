<?php

namespace Tests\Application;

use App\Domain\Student\Student;
use App\Domain\Student\StudentId;
use App\Domain\Course\Course;
use App\Domain\Course\CourseId;
use App\Domain\Student\StudentRepository;
use App\Domain\Course\CourseRepository;
use App\Domain\Enrollment\EnrollmentRepository;
use App\Application\EnrollStudent\EnrollStudentHandler;
use App\Application\EnrollStudent\EnrollStudentCommand;
use PHPUnit\Framework\TestCase;

final class EnrollStudentTest extends TestCase
{
    private Student $student;
    private Course $course;

    protected function setUp(): void
    {
        $this->student = new Student(
            new StudentId('student-1'),
            'Anna García',
            'anna@school.cat'
        );

        $this->course = new Course(
            new CourseId('course-1'),
            'DAW',
            'Desenvolvimento d\'Aplicacions Web',
            2024
        );
    }

    public function test_student_can_be_enrolled_in_a_course(): void
    {
        $studentRepo    = $this->createMock(StudentRepository::class);
        $courseRepo     = $this->createMock(CourseRepository::class);
        $enrollmentRepo = $this->createMock(EnrollmentRepository::class);

        $studentRepo->method('find')->willReturn($this->student);
        $courseRepo->method('find')->willReturn($this->course);
        $enrollmentRepo->method('existsEnrollment')->willReturn(false);

        $enrollmentRepo->expects($this->once())->method('save');

        $handler = new EnrollStudentHandler($studentRepo, $courseRepo, $enrollmentRepo);
        $handler->handle(new EnrollStudentCommand('student-1', 'course-1'));

        $this->assertTrue(true); // No exception thrown
    }

    public function test_enrollment_fails_when_student_not_found(): void
    {
        $studentRepo    = $this->createMock(StudentRepository::class);
        $courseRepo     = $this->createMock(CourseRepository::class);
        $enrollmentRepo = $this->createMock(EnrollmentRepository::class);

        $studentRepo->method('find')->willReturn(null);

        $handler = new EnrollStudentHandler($studentRepo, $courseRepo, $enrollmentRepo);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/not found/');

        $handler->handle(new EnrollStudentCommand('missing-student', 'course-1'));
    }

    public function test_enrollment_fails_when_course_not_found(): void
    {
        $studentRepo    = $this->createMock(StudentRepository::class);
        $courseRepo     = $this->createMock(CourseRepository::class);
        $enrollmentRepo = $this->createMock(EnrollmentRepository::class);

        $studentRepo->method('find')->willReturn($this->student);
        $courseRepo->method('find')->willReturn(null);

        $handler = new EnrollStudentHandler($studentRepo, $courseRepo, $enrollmentRepo);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/not found/');

        $handler->handle(new EnrollStudentCommand('student-1', 'missing-course'));
    }

    public function test_enrollment_fails_when_already_enrolled(): void
    {
        $studentRepo    = $this->createMock(StudentRepository::class);
        $courseRepo     = $this->createMock(CourseRepository::class);
        $enrollmentRepo = $this->createMock(EnrollmentRepository::class);

        $studentRepo->method('find')->willReturn($this->student);
        $courseRepo->method('find')->willReturn($this->course);
        $enrollmentRepo->method('existsEnrollment')->willReturn(true);

        $handler = new EnrollStudentHandler($studentRepo, $courseRepo, $enrollmentRepo);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/already enrolled/');

        $handler->handle(new EnrollStudentCommand('student-1', 'course-1'));
    }
}
