<?php

namespace Tests\Domain;

use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherId;
use PHPUnit\Framework\TestCase;

final class TeacherTest extends TestCase
{
    public function test_teacher_can_be_created(): void
    {
        $teacher = new Teacher(new TeacherId('t-1'), 'Marc López', 'marc@escola.cat', 'Programació');

        $this->assertEquals('Marc López', $teacher->name());
        $this->assertEquals('marc@escola.cat', $teacher->email());
        $this->assertEquals('Programació', $teacher->specialty());
    }

    // --- INVARIANTS ---

    public function test_teacher_cannot_have_empty_name(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/nom.*buit/i');

        new Teacher(new TeacherId('t-1'), '', 'marc@escola.cat', 'Prog');
    }

    public function test_teacher_cannot_have_invalid_email(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/email/i');

        new Teacher(new TeacherId('t-1'), 'Marc', 'no-valid', 'Prog');
    }

    public function test_teacher_cannot_have_empty_specialty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/especialitat/i');

        new Teacher(new TeacherId('t-1'), 'Marc', 'marc@escola.cat', '   ');
    }
}
