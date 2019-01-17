<?php

$configuration = require('config.php');

$container = new \Slim\Container($configuration);

$container['database'] = function($container) {
  $capsule = new \Illuminate\Database\Capsule\Manager;
  $capsule->addConnection($container['settings']['db']);
  $capsule->setAsGlobal();
  $capsule->bootEloquent();
  return $capsule;
};

$container['GraphQLController'] = function($container) {
  $maxDepth = isset($container['settings']['graphql']) && isset($container['settings']['graphql']['maxDepth']) ? $container['settings']['graphql']['maxDepth'] : 15;
  $introspection = isset($container['settings']['graphql']) && isset($container['settings']['graphql']['introspection']) ? $container['settings']['graphql']['introspection'] : true;
  $debug = isset($container['settings']['graphql']) && isset($container['settings']['graphql']['debug']) ? $container['settings']['graphql']['debug'] : 0;
  return new controllers\GraphQLController($container, $maxDepth, $introspection, $debug);
};

$container['authorRepository'] = function($container) {
  return new repositories\AuthorRepository($container->database, $container->logger);
};

$container['quoteRepository'] = function($container) {
  return new repositories\QuoteRepository($container->database, $container->logger);
};

$container['authorsResolver'] = function($container) {
  return new resolvers\AuthorsResolver($container->authorRepository);
};

$container['quotesResolver'] = function($container) {
  return new resolvers\QuotesResolver($container->quoteRepository);
};

$container['logger'] = function($container) {
  $logger = new \Monolog\Logger('graphql');
  if (isset($container['settings']['log']) && isset($container['settings']['log']['file'])) {
    $rotatingFileHandler = new \Monolog\Handler\RotatingFileHandler($container['settings']['log']['file']['file'], 10, $container['settings']['log']['file']['level']);
    $rotatingFileHandler->setFormatter(new \Monolog\Formatter\JsonFormatter());
    $logger->pushHandler($rotatingFileHandler);
  }

  return $logger;
};

return $container;
