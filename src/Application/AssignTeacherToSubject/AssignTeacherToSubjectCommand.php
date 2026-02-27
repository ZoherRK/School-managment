<?php

namespace App\Application\AssignTeacherToSubject;

class AssignTeacherToSubjectCommand
{
    public function __construct(
        public readonly string $teacherId,
        public readonly string $subjectId,
    ) {}
}
