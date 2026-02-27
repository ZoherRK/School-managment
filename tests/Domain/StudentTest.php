<?php

namespace Tests\Domain;

use App\Domain\Student\Student;
use App\Domain\Student\StudentId;
use PHPUnit\Framework\TestCase;

final class StudentTest extends TestCase
{
    public function test_student_can_be_created(): void
    {
        $student = new Student(new StudentId('s-1'), 'Pere Puig', 'pere@escola.cat');

        $this->assertEquals('s-1', $student->id()->value());
        $this->assertEquals('Pere Puig', $student->name());
        $this->assertEquals('pere@escola.cat', $student->email());
    }

    public function test_student_id_equality(): void
    {
        $id1 = new StudentId('abc-123');
        $id2 = new StudentId('abc-123');
        $id3 = new StudentId('xyz-999');

        $this->assertTrue($id1->equals($id2));
        $this->assertFalse($id1->equals($id3));
    }

    public function test_student_id_generates_unique_ids(): void
    {
        $this->assertNotEquals(StudentId::generate()->value(), StudentId::generate()->value());
    }

    // --- INVARIANTS ---

    public function test_student_cannot_have_empty_name(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/nom.*buit/i');

        new Student(new StudentId('s-1'), '   ', 'valid@email.cat');
    }

    public function test_student_cannot_have_invalid_email(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/email/i');

        new Student(new StudentId('s-1'), 'Pere', 'no-es-un-email');
    }

    public function test_student_cannot_have_email_without_domain(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Student(new StudentId('s-1'), 'Pere', 'pere@');
    }

    public function test_student_created_at_is_set_on_construction(): void
    {
        $before  = new \DateTimeImmutable();
        $student = new Student(new StudentId('s-1'), 'Laia', 'laia@test.cat');
        $after   = new \DateTimeImmutable();

        $this->assertGreaterThanOrEqual($before, $student->createdAt());
        $this->assertLessThanOrEqual($after, $student->createdAt());
    }
}
