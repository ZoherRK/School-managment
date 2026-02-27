<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\CreateSubject\CreateSubjectCommand;
use App\Application\CreateSubject\CreateSubjectHandler;
use App\Infrastructure\Persistence\DoctrineSubjectRepository;
use App\Infrastructure\Persistence\DoctrineCourseRepository;
use App\Domain\Subject\SubjectId;
use Doctrine\ORM\EntityManagerInterface;

class SubjectController
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function create(): void
    {
        $em = $this->em;
        $error = null;
        $courses = $em->getRepository(\App\Domain\Course\Course::class)->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $handler = new CreateSubjectHandler(
                new DoctrineSubjectRepository($em),
                new DoctrineCourseRepository($em),
            );
            try {
                $handler->handle(new CreateSubjectCommand(
                    SubjectId::generate()->value(),
                    htmlspecialchars($_POST['name']),
                    (int) $_POST['credits'],
                    $_POST['course_id'],
                ));
                header('Location: /subject?success=created');
                exit;
            } catch (\RuntimeException $e) {
                $error = $e->getMessage();
            }
        }

        require __DIR__ . '/../Views/subject/create.php';
    }
}
