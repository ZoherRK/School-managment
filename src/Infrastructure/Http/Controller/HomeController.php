<?php

namespace App\Infrastructure\Http\Controller;

use Doctrine\ORM\EntityManagerInterface;

class HomeController
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function index(): void
    {
        require __DIR__ . '/../Views/home/index.php';
    }

    public function student(): void
    {
        $em = $this->em;
        $students = $em->getRepository(\App\Domain\Student\Student::class)->findAll();
        require __DIR__ . '/../Views/student/index.php';
    }

    public function teacher(): void
    {
        $em = $this->em;
        $teachers = $em->getRepository(\App\Domain\Teacher\Teacher::class)->findAll();
        require __DIR__ . '/../Views/teacher/index.php';
    }

    public function course(): void
    {
        $em = $this->em;
        $courses = $em->getRepository(\App\Domain\Course\Course::class)->findAll();
        require __DIR__ . '/../Views/course/index.php';
    }

    public function subject(): void
    {
        $em = $this->em;
        $subjects = $em->getRepository(\App\Domain\Subject\Subject::class)->findAll();
        require __DIR__ . '/../Views/subject/index.php';
    }
}
