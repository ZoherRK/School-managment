<?php

namespace App\Application\EnrollStudent;

use App\Domain\Enrollment\Enrollment;
use App\Domain\Enrollment\EnrollmentRepository;
use App\Domain\Student\StudentId;
use App\Domain\Student\StudentRepository;
use App\Domain\Course\CourseId;
use App\Domain\Course\CourseRepository;

class EnrollStudentHandler
{
    public function __construct(
        public readonly StudentRepository $studentRepository,
        public readonly CourseRepository $courseRepository,
        public readonly EnrollmentRepository $enrollmentRepository,
    ) {}

    public function handle(EnrollStudentCommand $command): void
    {
        $studentId = new StudentId($command->studentId);
        $courseId  = new CourseId($command->courseId);

        $student = $this->studentRepository->find($studentId);
        if ($student === null) {
            throw new \RuntimeException("Student with id '{$command->studentId}' not found.");
        }

        $course = $this->courseRepository->find($courseId);
        if ($course === null) {
            throw new \RuntimeException("Course with id '{$command->courseId}' not found.");
        }

        $alreadyEnrolled = $this->enrollmentRepository->existsEnrollment($studentId, $courseId);
        if ($alreadyEnrolled) {
            throw new \RuntimeException("Student '{$student->name()}' is already enrolled in course '{$course->name()}'.");
        }

        $enrollment = Enrollment::enroll($student, $course);

        $this->enrollmentRepository->save($enrollment);
    }
}
