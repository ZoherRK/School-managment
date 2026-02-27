<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Enrollment\Enrollment;
use App\Domain\Enrollment\EnrollmentId;
use App\Domain\Enrollment\EnrollmentRepository;
use App\Domain\Student\StudentId;
use App\Domain\Course\CourseId;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineEnrollmentRepository implements EnrollmentRepository
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function save(Enrollment $enrollment): void
    {
        $this->em->persist($enrollment);
        $this->em->flush();
    }

    public function find(EnrollmentId $id): ?Enrollment
    {
        return $this->em->find(Enrollment::class, $id->value());
    }

    public function findAll(): array
    {
        return $this->em->getRepository(Enrollment::class)->findAll();
    }

    public function findByStudent(StudentId $studentId): array
    {
        return $this->em->getRepository(Enrollment::class)
            ->createQueryBuilder('e')
            ->join('e.student', 's')
            ->where('s.id = :studentId')
            ->setParameter('studentId', $studentId->value())
            ->getQuery()
            ->getResult();
    }

    public function findByCourse(CourseId $courseId): array
    {
        return $this->em->getRepository(Enrollment::class)
            ->createQueryBuilder('e')
            ->join('e.course', 'c')
            ->where('c.id = :courseId')
            ->setParameter('courseId', $courseId->value())
            ->getQuery()
            ->getResult();
    }

    public function existsEnrollment(StudentId $studentId, CourseId $courseId): bool
    {
        $result = $this->em->getRepository(Enrollment::class)
            ->createQueryBuilder('e')
            ->join('e.student', 's')
            ->join('e.course', 'c')
            ->where('s.id = :studentId AND c.id = :courseId')
            ->setParameter('studentId', $studentId->value())
            ->setParameter('courseId', $courseId->value())
            ->getQuery()
            ->getOneOrNullResult();

        return $result !== null;
    }
}
