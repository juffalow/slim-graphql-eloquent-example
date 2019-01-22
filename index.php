<?php

require './vendor/autoload.php';

$container = require('./config/container.php');

$app = new \Slim\App($container);

$app->get('/', function($request, $response) {
  return $response->write(file_get_contents(__DIR__ . '/src/graphiql/index.html'));
});

$app->post('/graphql', 'GraphQLController:process');

$app->run();
