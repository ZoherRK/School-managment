<?php

namespace App\Application\CreateSubject;

use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectId;
use App\Domain\Subject\SubjectRepository;
use App\Domain\Course\CourseId;
use App\Domain\Course\CourseRepository;

class CreateSubjectHandler
{
    public function __construct(
        public readonly SubjectRepository $subjectRepository,
        public readonly CourseRepository $courseRepository,
    ) {}

    public function handle(CreateSubjectCommand $command): void
    {
        $course = $this->courseRepository->find(new CourseId($command->courseId));

        if ($course === null) {
            throw new \RuntimeException("Course with id '{$command->courseId}' not found.");
        }

        $subject = new Subject(
            new SubjectId($command->subjectId),
            $command->name,
            $command->credits,
            $course,
        );

        $this->subjectRepository->save($subject);
    }
}
