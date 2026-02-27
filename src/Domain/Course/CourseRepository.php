<?php

namespace App\Domain\Course;

interface CourseRepository
{
    public function save(Course $course): void;
    public function find(CourseId $id): ?Course;
    public function findAll(): array;
}
