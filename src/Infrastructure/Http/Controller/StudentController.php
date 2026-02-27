<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\CreateStudent\CreateStudentCommand;
use App\Application\CreateStudent\CreateStudentHandler;
use App\Application\EnrollStudent\EnrollStudentCommand;
use App\Application\EnrollStudent\EnrollStudentHandler;
use App\Infrastructure\Persistence\DoctrineStudentRepository;
use App\Infrastructure\Persistence\DoctrineCourseRepository;
use App\Infrastructure\Persistence\DoctrineEnrollmentRepository;
use App\Domain\Student\StudentId;
use Doctrine\ORM\EntityManagerInterface;

class StudentController
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function create(): void
    {
        $em = $this->em;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $handler = new CreateStudentHandler(new DoctrineStudentRepository($em));
            try {
                $handler->handle(new CreateStudentCommand(
                    StudentId::generate()->value(),
                    htmlspecialchars($_POST['name']),
                    htmlspecialchars($_POST['email']),
                ));
                header('Location: /student?success=created');
                exit;
            } catch (\RuntimeException $e) {
                $error = $e->getMessage();
            }
        }

        require __DIR__ . '/../Views/student/create.php';
    }

    public function enroll(): void
    {
        $em = $this->em;
        $error = null;
        $courses  = $em->getRepository(\App\Domain\Course\Course::class)->findAll();
        $students = $em->getRepository(\App\Domain\Student\Student::class)->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $handler = new EnrollStudentHandler(
                new DoctrineStudentRepository($em),
                new DoctrineCourseRepository($em),
                new DoctrineEnrollmentRepository($em),
            );
            try {
                $handler->handle(new EnrollStudentCommand(
                    $_POST['student_id'],
                    $_POST['course_id'],
                ));
                header('Location: /student?success=enrolled');
                exit;
            } catch (\RuntimeException $e) {
                $error = $e->getMessage();
            }
        }

        require __DIR__ . '/../Views/student/enroll.php';
    }
}
