<?php

namespace App\Domain\Enrollment;

use App\Domain\Student\StudentId;
use App\Domain\Course\CourseId;

interface EnrollmentRepository
{
    public function save(Enrollment $enrollment): void;
    public function find(EnrollmentId $id): ?Enrollment;
    public function findAll(): array;
    public function findByStudent(StudentId $studentId): array;
    public function findByCourse(CourseId $courseId): array;
    public function existsEnrollment(StudentId $studentId, CourseId $courseId): bool;
}
