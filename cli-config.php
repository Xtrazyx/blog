<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use JHD\Framework\DoctrineEntityManager;

require_once __DIR__ . '/web/web_app.php';

class Loader{
    use DoctrineEntityManager;
}

$loader = new Loader();
$entityManager = $loader->getEntityManager();
return ConsoleRunner::createHelperSet($entityManager);