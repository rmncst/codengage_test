<?php

require __DIR__."/../vendor/autoload.php";

$app = new Silex\Application();

/**
 * Registrando todos os providers da aplicação
 *
 * Dentro deste provider, você encontra todos os provider que a aplicação está utilizando
 */
$app->register(new \Application\Provider\ApplicationProvider());


$app->run();