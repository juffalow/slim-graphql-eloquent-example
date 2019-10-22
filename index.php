<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';

$container = require('./config/container.php');

$app = new \Slim\App($container);

$app->add(new middlewares\CORS());

$app->get('/', function(Request $request, Response $response) {
  return $response->write(file_get_contents(__DIR__ . '/src/graphiql/index.html'));
});

$app->post('/graphql', 'GraphQLController:process');

$app->run();
