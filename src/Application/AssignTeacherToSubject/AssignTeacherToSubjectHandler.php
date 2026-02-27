<?php

namespace App\Application\AssignTeacherToSubject;

use App\Domain\Subject\SubjectId;
use App\Domain\Subject\SubjectRepository;
use App\Domain\Teacher\TeacherId;
use App\Domain\Teacher\TeacherRepository;

class AssignTeacherToSubjectHandler
{
    public function __construct(
        public readonly TeacherRepository $teacherRepository,
        public readonly SubjectRepository $subjectRepository,
    ) {}

    public function handle(AssignTeacherToSubjectCommand $command): void
    {
        $teacher = $this->teacherRepository->find(new TeacherId($command->teacherId));
        if ($teacher === null) {
            throw new \RuntimeException("Teacher with id '{$command->teacherId}' not found.");
        }

        $subject = $this->subjectRepository->find(new SubjectId($command->subjectId));
        if ($subject === null) {
            throw new \RuntimeException("Subject with id '{$command->subjectId}' not found.");
        }

        // Domain method handles the assignment
        $subject->assignTeacher($teacher);

        $this->subjectRepository->save($subject);
    }
}
