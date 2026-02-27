<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectId;
use App\Domain\Subject\SubjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineSubjectRepository implements SubjectRepository
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function save(Subject $subject): void
    {
        $this->em->persist($subject);
        $this->em->flush();
    }

    public function find(SubjectId $id): ?Subject
    {
        return $this->em->find(Subject::class, $id->value());
    }

    public function findAll(): array
    {
        return $this->em->getRepository(Subject::class)->findAll();
    }

    public function findByCourse(string $courseId): array
    {
        return $this->em->getRepository(Subject::class)
            ->createQueryBuilder('s')
            ->join('s.course', 'c')
            ->where('c.id = :courseId')
            ->setParameter('courseId', $courseId)
            ->getQuery()
            ->getResult();
    }
}
