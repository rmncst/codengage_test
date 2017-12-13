<?php

use Application\Provider\DoctrineOrmProvider;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__."/../vendor/autoload.php";


return ConsoleRunner::createHelperSet(DoctrineOrmProvider::bootstrapCliConnection());


