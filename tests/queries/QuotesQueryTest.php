<?php

use PHPUnit\Framework\TestCase;
use GraphQL\GraphQL;

$container = require(__DIR__ . '/../../config/container.php');

final class QuotesQueryTest extends TestCase {
  public function testWithNumericId(): void {
    $schema = require(__DIR__ . '/../../src/schema/schema.php');
    $query = <<<EOD
      query {
        quotes(first: 3) {
          edges {
            node {
              id
              _id
              quote
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
      'id' => 'cXVvdGUx',
      '_id' => 1,
      'quote' => 'First, solve the problem. Then, write the code.',
    ], $output['data']['quotes']['edges'][0]['node']);
    $this->assertEquals([
      'id' => 'cXVvdGUy',
      '_id' => 2,
      'quote' => 'Any fool can write code that a computer can understand. Good programmers write code that humans can understand.',
    ], $output['data']['quotes']['edges'][1]['node']);
    $this->assertEquals([
      'id' => 'cXVvdGUz',
      '_id' => 3,
      'quote' => 'If you stop learning, then the projects you work on are stuck in whatever time period you decided to settle.',
    ], $output['data']['quotes']['edges'][2]['node']);
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
