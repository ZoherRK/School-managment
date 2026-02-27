<?php

namespace App\Application\CreateCourse;

class CreateCourseCommand
{
    public function __construct(
        public readonly string $courseId,
        public readonly string $name,
        public readonly string $description,
        public readonly int $year,
    ) {}
}
