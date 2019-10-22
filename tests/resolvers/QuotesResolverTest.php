<?php

use PHPUnit\Framework\TestCase;
use resolvers\QuotesResolver;
use models\Quote as QuoteModel;
use repositories\QuoteRepositoryInterface;

class QuoteRepositoryMock implements QuoteRepositoryInterface {

  public function get(int $id): QuoteModel {

  }

  public function find(int $first, ?int $after, ?string $quote, ?array $orderBy) {
    $array = [];

    for($i = 0; $i < $first; $i++) {
      $array[] = new QuoteModel(['id' => $i + 1, 'quote' => "quote{$i}", 'authorId' => $i]);
    }

    return $array;
  }

  public function count(?string $quote): int {
    return 15;
  }

  public function create(int $authorId, string $quote): QuoteModel {

  }

  public function delete(int $id): ?QuoteModel {

  }

  public function update(int $id, ?string $quote): ?QuoteModel {

  }
}

final class QuotesResolverTest extends TestCase {
  public function testResolve(): void {
    $resolver = new QuotesResolver(new QuoteRepositoryMock());
    $args = [
      'first' => 5,
    ];

    $response = $resolver->resolve($args);

    $this->assertEquals(
      15,
      $response['totalCount']
    );

    $this->assertEquals(
      base64_encode('cursor5'),
      $response['pageInfo']['endCursor']
    );

    $this->assertEquals(
      true,
      $response['pageInfo']['hasNextPage']
    );

    $this->assertEquals(
      false,
      $response['pageInfo']['hasPreviousPage']
    );

    $this->assertEquals(
      base64_encode('cursor1'),
      $response['pageInfo']['startCursor']
    );

    $this->assertEquals(
      base64_encode('cursor1'),
      $response['edges'][0]['cursor']
    );

    $this->assertEquals(
      1,
      $response['edges'][0]['node']->getId()
    );

    $this->assertEquals(
      'quote0',
      $response['edges'][0]['node']->getQuote()
    );

    $this->assertEquals(
      0,
      $response['edges'][0]['node']->getAuthorId()
    );

    $this->assertEquals(
      base64_encode('cursor5'),
      $response['edges'][4]['cursor']
    );

    $this->assertEquals(
      5,
      $response['edges'][4]['node']->getId()
    );

    $this->assertEquals(
      'quote4',
      $response['edges'][4]['node']->getQuote()
    );

    $this->assertEquals(
      4,
      $response['edges'][4]['node']->getAuthorId()
    );
  }
}
