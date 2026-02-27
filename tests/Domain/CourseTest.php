<?php

namespace Tests\Domain;

use App\Domain\Course\Course;
use App\Domain\Course\CourseId;
use PHPUnit\Framework\TestCase;

final class CourseTest extends TestCase
{
    public function test_course_can_be_created(): void
    {
        $course = new Course(new CourseId('c-1'), 'DAW', 'Desc', 2024);

        $this->assertEquals('DAW', $course->name());
        $this->assertEquals(2024, $course->year());
    }

    // --- INVARIANTS ---

    public function test_course_cannot_have_empty_name(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/nom.*buit/i');

        new Course(new CourseId('c-1'), '', 'Desc', 2024);
    }

    public function test_course_year_cannot_be_before_2000(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/any/i');

        new Course(new CourseId('c-1'), 'DAW', 'Desc', 1999);
    }

    public function test_course_year_cannot_be_after_2100(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/any/i');

        new Course(new CourseId('c-1'), 'DAW', 'Desc', 2101);
    }

    public function test_course_boundary_years_are_valid(): void
    {
        $c1 = new Course(new CourseId('c-1'), 'DAW', 'Desc', 2000);
        $c2 = new Course(new CourseId('c-2'), 'DAW', 'Desc', 2100);

        $this->assertEquals(2000, $c1->year());
        $this->assertEquals(2100, $c2->year());
    }
}
