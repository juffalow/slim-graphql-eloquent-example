<?php

namespace controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use GraphQL\GraphQL;
use GraphQL\Validator\Rules\DisableIntrospection;
use GraphQL\Validator\DocumentValidator;
use GraphQL\Validator\Rules\QueryDepth;

/**
 *
 * @author Matej 'juffalow' Jellus <juffalow@juffalow.com>
 */
class GraphQLController {

  protected $container;

  protected $maxDepth;

  protected $introspection;

  protected $debug;

  public function __construct($container, int $maxDepth = 15, bool $introspection = true, int $debug = 0) {
    $this->container = $container;
    $this->maxDepth = $maxDepth;
    $this->introspection = $introspection;
    $this->debug = $debug;
  }

  public function process(Request $request, Response $response) {
    $schema = require(__DIR__ . '/../schema/schema.php');
    $input = json_decode($request->getBody(), true);
    $query = isset($input['query']) ? $input['query'] : null;
    $variableValues = isset($input['variables']) ? $input['variables'] : null;

    $context = $this->getContext();

    if (!$this->introspection) {
      DocumentValidator::addRule(new DisableIntrospection());
    }

    DocumentValidator::addRule(new QueryDepth($this->maxDepth));

    try {
      $schema->assertValid();
      $result = GraphQL::executeQuery($schema, $query, null, $context, $variableValues);

      $output = $result->toArray($this->debug);
    } catch (\Exception $e) {
      throw $e;
      $output = [
        'errors' => [
          [
            'message' => $e->getMessage()
          ]
        ]
      ];
    }

    return $response->withJson($output);
  }

  protected function getContext() {
    $container = $this->container;

    return new \Slim\Container([
      'service' => new \Slim\Container([
        'logger' => $container->logger,
      ]),
      'resolver' => new \Slim\Container([
        'authors' => function() use($container) {
          return $container->authorsResolver;
        },
        'quotes' => function() use($container) {
          return $container->quotesResolver;
        },
      ]),
      'repository' => new \Slim\Container([
        'author' => function() use($container) {
          return $container->authorRepository;
        },
        'quote' => function() use($container) {
          return $container->quoteRepository;
        },
      ])
    ]);
  }
}
