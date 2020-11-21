<?php

use PHPUnit\Framework\TestCase;
use GraphQL\GraphQL;

$container = require(__DIR__ . '/../../config/container.php');

final class AuthorsQueryTest extends TestCase {
  public function testWithNumericId(): void {
    $schema = require(__DIR__ . '/../../src/schema/schema.php');
    $query = <<<EOD
      query {
        authors(first: 3) {
          edges {
            node {
              id
              _id
              firstName
              lastName
            }
          }
        }
      }
EOD;
    $context = $this->getContext();

    $result = GraphQL::executeQuery($schema, $query, null, $context, null);
    $output = $result->toArray(0);

    $this->assertArrayHasKey('data', $output);
    $this->assertArrayNotHasKey('errors', $output);
    $this->assertEquals([
      'id' => 'YXV0aG9yMQ==',
      '_id' => 1,
      'firstName' => 'John',
      'lastName' => 'Johnson',
    ], $output['data']['authors']['edges'][0]['node']);
    $this->assertEquals([
      'id' => 'YXV0aG9yMg==',
      '_id' => 2,
      'firstName' => 'Martin',
      'lastName' => 'Fowler',
    ], $output['data']['authors']['edges'][1]['node']);
    $this->assertEquals([
      'id' => 'YXV0aG9yMw==',
      '_id' => 3,
      'firstName' => 'Jason',
      'lastName' => 'Lengstorf',
    ], $output['data']['authors']['edges'][2]['node']);
  }

  protected function getContext() {
    global $container;
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
