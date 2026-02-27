<?php

namespace Tests\Domain;

use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectId;
use App\Domain\Course\Course;
use App\Domain\Course\CourseId;
use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherId;
use PHPUnit\Framework\TestCase;

final class SubjectTest extends TestCase
{
    private Course $course;

    protected function setUp(): void
    {
        $this->course = new Course(new CourseId('c-1'), 'DAW', 'Desc', 2024);
    }

    public function test_subject_can_be_created_without_teacher(): void
    {
        $subject = new Subject(new SubjectId('s-1'), 'Bases de Dades', 4, $this->course);

        $this->assertEquals('Bases de Dades', $subject->name());
        $this->assertEquals(4, $subject->credits());
        $this->assertNull($subject->teacher());
    }

    public function test_subject_can_assign_teacher(): void
    {
        $subject = new Subject(new SubjectId('s-1'), 'Programació Web', 6, $this->course);
        $teacher = new Teacher(new TeacherId('t-1'), 'Maria Soler', 'maria@escola.cat', 'Programació');

        $subject->assignTeacher($teacher);

        $this->assertSame($teacher, $subject->teacher());
    }

    public function test_subject_teacher_can_be_reassigned(): void
    {
        $subject  = new Subject(new SubjectId('s-1'), 'Xarxes', 3, $this->course);
        $teacher1 = new Teacher(new TeacherId('t-1'), 'Joan', 'joan@escola.cat', 'Xarxes');
        $teacher2 = new Teacher(new TeacherId('t-2'), 'Núria', 'nuria@escola.cat', 'Xarxes');

        $subject->assignTeacher($teacher1);
        $subject->assignTeacher($teacher2);

        $this->assertEquals('Núria', $subject->teacher()->name());
    }

    // --- INVARIANTS ---

    public function test_subject_cannot_have_empty_name(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/nom.*buit/i');

        new Subject(new SubjectId('s-1'), '', 4, $this->course);
    }

    public function test_subject_credits_cannot_be_zero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/crèdits/i');

        new Subject(new SubjectId('s-1'), 'Nom', 0, $this->course);
    }

    public function test_subject_credits_cannot_exceed_12(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/crèdits/i');

        new Subject(new SubjectId('s-1'), 'Nom', 13, $this->course);
    }

    public function test_subject_credits_boundary_values_are_valid(): void
    {
        $s1 = new Subject(new SubjectId('s-1'), 'Mín', 1, $this->course);
        $s2 = new Subject(new SubjectId('s-2'), 'Màx', 12, $this->course);

        $this->assertEquals(1, $s1->credits());
        $this->assertEquals(12, $s2->credits());
    }
}
