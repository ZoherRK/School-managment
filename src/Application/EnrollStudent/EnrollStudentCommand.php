<?php

namespace App\Application\EnrollStudent;

class EnrollStudentCommand
{
    public function __construct(
        public readonly string $studentId,
        public readonly string $courseId,
    ) {}
}
