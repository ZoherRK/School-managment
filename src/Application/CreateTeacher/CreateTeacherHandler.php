<?php

namespace App\Application\CreateTeacher;

use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherId;
use App\Domain\Teacher\TeacherRepository;

class CreateTeacherHandler
{
    public function __construct(
        public readonly TeacherRepository $teacherRepository
    ) {}

    public function handle(CreateTeacherCommand $command): void
    {
        $existing = $this->teacherRepository->findByEmail($command->email);

        if ($existing !== null) {
            throw new \RuntimeException("A teacher with email '{$command->email}' already exists.");
        }

        $teacher = new Teacher(
            new TeacherId($command->teacherId),
            $command->name,
            $command->email,
            $command->specialty,
        );

        $this->teacherRepository->save($teacher);
    }
}
