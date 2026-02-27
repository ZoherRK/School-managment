<?php

$em = require __DIR__ . '/bootstrap.php';

use App\Infrastructure\Http\Controller\HomeController;
use App\Infrastructure\Http\Controller\StudentController;
use App\Infrastructure\Http\Controller\TeacherController;
use App\Infrastructure\Http\Controller\CourseController;
use App\Infrastructure\Http\Controller\SubjectController;

$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$routes = [
    'GET'  => [
        '/'               => [HomeController::class,    'index'],
        '/student'        => [HomeController::class,    'student'],
        '/student/create' => [StudentController::class, 'create'],
        '/student/enroll' => [StudentController::class, 'enroll'],
        '/teacher'        => [HomeController::class,    'teacher'],
        '/teacher/create' => [TeacherController::class, 'create'],
        '/teacher/assign' => [TeacherController::class, 'assign'],
        '/course'         => [HomeController::class,    'course'],
        '/course/create'  => [CourseController::class,  'create'],
        '/subject'        => [HomeController::class,    'subject'],
        '/subject/create' => [SubjectController::class, 'create'],
    ],
    'POST' => [
        '/student/create' => [StudentController::class, 'create'],
        '/student/enroll' => [StudentController::class, 'enroll'],
        '/teacher/create' => [TeacherController::class, 'create'],
        '/teacher/assign' => [TeacherController::class, 'assign'],
        '/course/create'  => [CourseController::class,  'create'],
        '/subject/create' => [SubjectController::class, 'create'],
    ],
];

if (isset($routes[$method][$uri])) {
    [$controllerClass, $action] = $routes[$method][$uri];
    $controller = new $controllerClass($em);
    $controller->$action();
} else {
    http_response_code(404);
    echo '<h1>404 - Pàgina no trobada</h1><a href="/">Tornar a l\'inici</a>';
}
