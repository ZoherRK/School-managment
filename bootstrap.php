<?php

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/src/Domain'],
    isDevMode: true,
);

if (!is_dir(__DIR__ . '/db')) {
    mkdir(__DIR__ . '/db', 0755, true);
}

$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path'   => __DIR__ . '/db/school.sqlite',
], $config);

$em = new EntityManager($connection, $config);

return $em;
