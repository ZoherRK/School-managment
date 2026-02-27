<?php

namespace App\Application\CreateTeacher;

class CreateTeacherCommand
{
    public function __construct(
        public readonly string $teacherId,
        public readonly string $name,
        public readonly string $email,
        public readonly string $specialty,
    ) {}
}
