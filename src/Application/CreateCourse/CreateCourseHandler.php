<?php

namespace App\Application\CreateCourse;

use App\Domain\Course\Course;
use App\Domain\Course\CourseId;
use App\Domain\Course\CourseRepository;

class CreateCourseHandler
{
    public function __construct(
        public readonly CourseRepository $courseRepository
    ) {}

    public function handle(CreateCourseCommand $command): void
    {
        $course = new Course(
            new CourseId($command->courseId),
            $command->name,
            $command->description,
            $command->year,
        );

        $this->courseRepository->save($course);
    }
}
