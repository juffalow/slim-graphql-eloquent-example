<?php

use controllers\GraphQLController;

require './vendor/autoload.php';

$container = require('./config/container.php');

$app = new \Slim\App($container);

/**
 * Enable CORS for all routes
 * Please change the `origin` header according to requirement
 */
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

/**
 * graphql routes
 */
$app->post('/graphql', GraphQLController::class .':process');

$app->run();
