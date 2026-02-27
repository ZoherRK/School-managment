<?php

namespace App\Application\CreateSubject;

class CreateSubjectCommand
{
    public function __construct(
        public readonly string $subjectId,
        public readonly string $name,
        public readonly int $credits,
        public readonly string $courseId,
    ) {}
}
