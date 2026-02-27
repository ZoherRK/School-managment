<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\CreateTeacher\CreateTeacherCommand;
use App\Application\CreateTeacher\CreateTeacherHandler;
use App\Application\AssignTeacherToSubject\AssignTeacherToSubjectCommand;
use App\Application\AssignTeacherToSubject\AssignTeacherToSubjectHandler;
use App\Infrastructure\Persistence\DoctrineTeacherRepository;
use App\Infrastructure\Persistence\DoctrineSubjectRepository;
use App\Domain\Teacher\TeacherId;
use Doctrine\ORM\EntityManagerInterface;

class TeacherController
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function create(): void
    {
        $em = $this->em;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $handler = new CreateTeacherHandler(new DoctrineTeacherRepository($em));
            try {
                $handler->handle(new CreateTeacherCommand(
                    TeacherId::generate()->value(),
                    htmlspecialchars($_POST['name']),
                    htmlspecialchars($_POST['email']),
                    htmlspecialchars($_POST['specialty']),
                ));
                header('Location: /teacher?success=created');
                exit;
            } catch (\RuntimeException $e) {
                $error = $e->getMessage();
            }
        }

        require __DIR__ . '/../Views/teacher/create.php';
    }

    public function assign(): void
    {
        $em = $this->em;
        $error = null;
        $teachers = $em->getRepository(\App\Domain\Teacher\Teacher::class)->findAll();
        $subjects = $em->getRepository(\App\Domain\Subject\Subject::class)->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $handler = new AssignTeacherToSubjectHandler(
                new DoctrineTeacherRepository($em),
                new DoctrineSubjectRepository($em),
            );
            try {
                $handler->handle(new AssignTeacherToSubjectCommand(
                    $_POST['teacher_id'],
                    $_POST['subject_id'],
                ));
                header('Location: /teacher?success=assigned');
                exit;
            } catch (\RuntimeException $e) {
                $error = $e->getMessage();
            }
        }

        require __DIR__ . '/../Views/teacher/assign.php';
    }
}
