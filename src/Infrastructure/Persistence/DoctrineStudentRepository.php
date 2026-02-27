<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Student\Student;
use App\Domain\Student\StudentId;
use App\Domain\Student\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineStudentRepository implements StudentRepository
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function save(Student $student): void
    {
        $this->em->persist($student);
        $this->em->flush();
    }

    public function find(StudentId $id): ?Student
    {
        return $this->em->find(Student::class, $id->value());
    }

    public function findAll(): array
    {
        return $this->em->getRepository(Student::class)->findAll();
    }

    public function findByEmail(string $email): ?Student
    {
        return $this->em->getRepository(Student::class)->findOneBy(['email' => $email]);
    }
}
