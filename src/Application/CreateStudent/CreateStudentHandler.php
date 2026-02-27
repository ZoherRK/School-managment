<?php

namespace App\Application\CreateStudent;

use App\Domain\Student\Student;
use App\Domain\Student\StudentId;
use App\Domain\Student\StudentRepository;

class CreateStudentHandler
{
    public function __construct(
        public readonly StudentRepository $studentRepository
    ) {}

    public function handle(CreateStudentCommand $command): void
    {
        $existing = $this->studentRepository->findByEmail($command->email);

        if ($existing !== null) {
            throw new \RuntimeException("A student with email '{$command->email}' already exists.");
        }

        $student = new Student(
            new StudentId($command->studentId),
            $command->name,
            $command->email,
        );

        $this->studentRepository->save($student);
    }
}
