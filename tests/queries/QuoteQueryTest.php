<?php

use PHPUnit\Framework\TestCase;
use GraphQL\GraphQL;

$container = require(__DIR__ . '/../../config/container.php');

final class QuoteQueryTest extends TestCase {
  public function testWithNumericId(): void {
    $schema = require(__DIR__ . '/../../src/schema/schema.php');
    $query = <<<EOD
      query {
        quote(id: 1) {
          id
          _id
          quote
        }
      }
EOD;
    $context = $this->getContext();

    $result = GraphQL::executeQuery($schema, $query, null, $context, null);
    $output = $result->toArray(0);

    $this->assertArrayHasKey('data', $output);
    $this->assertArrayNotHasKey('errors', $output);
    $this->assertEquals([
      'id' => 'cXVvdGUx',
      '_id' => 1,
      'quote' => 'First, solve the problem. Then, write the code.',
    ], $output['data']['quote']);
  }

  public function testWithStringId(): void {
    $schema = require(__DIR__ . '/../../src/schema/schema.php');
    $query = <<<EOD
      query {
        quote(id: "cXVvdGUy") {
          id
          _id
          quote
        }
      }
EOD;
    $context = $this->getContext();

    $result = GraphQL::executeQuery($schema, $query, null, $context, null);
    $output = $result->toArray(0);

    $this->assertArrayHasKey('data', $output);
    $this->assertArrayNotHasKey('errors', $output);
    $this->assertEquals([
      'id' => 'cXVvdGUy',
      '_id' => 2,
      'quote' => 'Any fool can write code that a computer can understand. Good programmers write code that humans can understand.',
    ], $output['data']['quote']);
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
