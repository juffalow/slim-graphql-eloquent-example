<?php

$configuration = require('config.php');

$container = new \Slim\Container($configuration);

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$container->database = $capsule;

return $container;
