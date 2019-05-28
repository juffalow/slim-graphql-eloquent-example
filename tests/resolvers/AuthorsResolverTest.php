<?php

use PHPUnit\Framework\TestCase;
use resolvers\AuthorsResolver;
use models\Author as AuthorModel;
use repositories\AuthorRepositoryInterface;

class AuthorRepositoryMock implements AuthorRepositoryInterface {

  public function get(int $id): ?AuthorModel {

  }

  public function find(int $first, ?int $after, ?string $firstName, ?string $lastName, ?array $orderBy) {
    $array = [];
    
    for($i = 0; $i < $first; $i++) {
      $array[] = new AuthorModel(['id' => $i + 1, 'firstName' => "firstName{$i}", 'lastName' => "lastName{$i}"]);
    }

    return $array;
  }

  public function count(?string $firstName, ?string $lastName): int {
    return 15;
  }

  public function create(string $fistName, string $lastName): AuthorModel {
    
  }

  public function delete(int $id): ?AuthorModel {

  }

  public function update(int $id, ?string $firstName, ?string $lastName): ?AuthorModel {

  }
}

final class AuthorsResolverTest extends TestCase {
  public function testResolve(): void {
    $resolver = new AuthorsResolver(new AuthorRepositoryMock());
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
      'firstName0',
      $response['edges'][0]['node']->getFirstName()
    );

    $this->assertEquals(
      'lastName0',
      $response['edges'][0]['node']->getLastName()
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
      'firstName4',
      $response['edges'][4]['node']->getFirstName()
    );

    $this->assertEquals(
      'lastName4',
      $response['edges'][4]['node']->getLastName()
    );
  }
}
