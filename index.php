<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';

$container = require('./config/container.php');

$app = new \Slim\App($container);

\di\AppFactory::setContainer($container);

use GraphQL\GraphQL;

$app->post('/graphql', function(Request $request, Response $response) {
  $schema = require('./schema/schema.php');
  $input = json_decode($request->getBody(), true);
  $query = $input['query'];
  $variableValues = isset($input['variables']) ? $input['variables'] : null;

  try {
    $rootValue = ['prefix' => 'You said: '];
    $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
    $output = $result->toArray();
  } catch (\Exception $e) {
    $output = [
      'errors' => [
        [
          'message' => $e->getMessage()
        ]
      ]
    ];
  }
  return $response->withJson($output);
});

$app->run();
