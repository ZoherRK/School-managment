<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\CreateCourse\CreateCourseCommand;
use App\Application\CreateCourse\CreateCourseHandler;
use App\Infrastructure\Persistence\DoctrineCourseRepository;
use App\Domain\Course\CourseId;
use Doctrine\ORM\EntityManagerInterface;

class CourseController
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function create(): void
    {
        $em = $this->em;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $handler = new CreateCourseHandler(new DoctrineCourseRepository($em));
            try {
                $handler->handle(new CreateCourseCommand(
                    CourseId::generate()->value(),
                    htmlspecialchars($_POST['name']),
                    htmlspecialchars($_POST['description']),
                    (int) $_POST['year'],
                ));
                header('Location: /course?success=created');
                exit;
            } catch (\RuntimeException $e) {
                $error = $e->getMessage();
            }
        }

        require __DIR__ . '/../Views/course/create.php';
    }
}
