<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Course\Course;
use App\Domain\Course\CourseId;
use App\Domain\Course\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineCourseRepository implements CourseRepository
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function save(Course $course): void
    {
        $this->em->persist($course);
        $this->em->flush();
    }

    public function find(CourseId $id): ?Course
    {
        return $this->em->find(Course::class, $id->value());
    }

    public function findAll(): array
    {
        return $this->em->getRepository(Course::class)->findAll();
    }
}
