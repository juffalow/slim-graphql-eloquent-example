<?php

require './vendor/autoload.php';

$container = require('./config/container.php');

$app = new \Slim\App($container);

$app->post('/graphql', 'GraphQLController:process');

$app->run();
