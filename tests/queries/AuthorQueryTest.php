<?php

use PHPUnit\Framework\TestCase;
use GraphQL\GraphQL;

$container = require(__DIR__ . '/../../config/container.php');

final class AuthorQueryTest extends TestCase {
  public function testWithNumericId(): void {
    $schema = require(__DIR__ . '/../../src/schema/schema.php');
    $query = <<<EOD
      query {
        author(id: 1) {
          id
          _id
          firstName
          lastName
        }
      }
EOD;
    $context = $this->getContext();

    $result = GraphQL::executeQuery($schema, $query, null, $context, null);
    $output = $result->toArray(1);

    print_r($output);

    $this->assertArrayHasKey('data', $output);
    $this->assertArrayNotHasKey('errors', $output);
    $this->assertEquals([
      'id' => 'YXV0aG9yMQ==',
      '_id' => 1,
      'firstName' => 'John',
      'lastName' => 'Johnson',
    ], $output['data']['author']);
  }

  public function testWithStringId(): void {
    $schema = require(__DIR__ . '/../../src/schema/schema.php');
    $query = <<<EOD
      query {
        author(id: "YXV0aG9yMg==") {
          id
          _id
          firstName
          lastName
        }
      }
EOD;
    $context = $this->getContext();

    $result = GraphQL::executeQuery($schema, $query, null, $context, null);
    $output = $result->toArray(0);

    $this->assertArrayHasKey('data', $output);
    $this->assertArrayNotHasKey('errors', $output);
    $this->assertEquals([
      'id' => 'YXV0aG9yMg==',
      '_id' => 2,
      'firstName' => 'Martin',
      'lastName' => 'Fowler',
    ], $output['data']['author']);
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
