<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherId;
use App\Domain\Teacher\TeacherRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineTeacherRepository implements TeacherRepository
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function save(Teacher $teacher): void
    {
        $this->em->persist($teacher);
        $this->em->flush();
    }

    public function find(TeacherId $id): ?Teacher
    {
        return $this->em->find(Teacher::class, $id->value());
    }

    public function findAll(): array
    {
        return $this->em->getRepository(Teacher::class)->findAll();
    }

    public function findByEmail(string $email): ?Teacher
    {
        return $this->em->getRepository(Teacher::class)->findOneBy(['email' => $email]);
    }
}
