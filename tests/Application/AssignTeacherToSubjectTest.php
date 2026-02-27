<?php

namespace Tests\Application;

use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherId;
use App\Domain\Course\Course;
use App\Domain\Course\CourseId;
use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectId;
use App\Domain\Teacher\TeacherRepository;
use App\Domain\Subject\SubjectRepository;
use App\Application\AssignTeacherToSubject\AssignTeacherToSubjectHandler;
use App\Application\AssignTeacherToSubject\AssignTeacherToSubjectCommand;
use PHPUnit\Framework\TestCase;

final class AssignTeacherToSubjectTest extends TestCase
{
    private Teacher $teacher;
    private Subject $subject;

    protected function setUp(): void
    {
        $this->teacher = new Teacher(
            new TeacherId('teacher-1'),
            'Marc López',
            'marc@school.cat',
            'Programació'
        );

        $course = new Course(
            new CourseId('course-1'),
            'DAW',
            'Desenvolupament d\'Aplicacions Web',
            2024
        );

        $this->subject = new Subject(
            new SubjectId('subject-1'),
            'Programació Web',
            6,
            $course
        );
    }

    public function test_teacher_can_be_assigned_to_subject(): void
    {
        $teacherRepo  = $this->createMock(TeacherRepository::class);
        $subjectRepo  = $this->createMock(SubjectRepository::class);

        $teacherRepo->method('find')->willReturn($this->teacher);
        $subjectRepo->method('find')->willReturn($this->subject);

        $subjectRepo->expects($this->once())->method('save');

        $handler = new AssignTeacherToSubjectHandler($teacherRepo, $subjectRepo);
        $handler->handle(new AssignTeacherToSubjectCommand('teacher-1', 'subject-1'));

        // Verify the teacher was actually assigned in the domain object
        $this->assertSame($this->teacher, $this->subject->teacher());
    }

    public function test_assignment_fails_when_teacher_not_found(): void
    {
        $teacherRepo = $this->createMock(TeacherRepository::class);
        $subjectRepo = $this->createMock(SubjectRepository::class);

        $teacherRepo->method('find')->willReturn(null);

        $handler = new AssignTeacherToSubjectHandler($teacherRepo, $subjectRepo);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/not found/');

        $handler->handle(new AssignTeacherToSubjectCommand('missing-teacher', 'subject-1'));
    }

    public function test_assignment_fails_when_subject_not_found(): void
    {
        $teacherRepo = $this->createMock(TeacherRepository::class);
        $subjectRepo = $this->createMock(SubjectRepository::class);

        $teacherRepo->method('find')->willReturn($this->teacher);
        $subjectRepo->method('find')->willReturn(null);

        $handler = new AssignTeacherToSubjectHandler($teacherRepo, $subjectRepo);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/not found/');

        $handler->handle(new AssignTeacherToSubjectCommand('teacher-1', 'missing-subject'));
    }
}
