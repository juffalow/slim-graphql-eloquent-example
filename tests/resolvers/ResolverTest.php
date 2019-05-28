<?php

use PHPUnit\Framework\TestCase;
use resolvers\Resolver;
use models\Author;

class ExampleResolver extends Resolver {
  public function resolve(array $args) {

  }

  public function publicIsSet($array, $key) {
    return $this->isSet($array, $key);
  }

  public function publicGetValue(array $array, string $key, $default = null) {
    return $this->getValue($array, $key, $default);
  }

  public function publicNodesToEdges($nodes, $after) {
    return $this->nodesToEdges($nodes, $after);
  }

  public function publicGetCursor(array $args, string $key) {
    return $this->getCursor($args, $key);
  }
}

final class ResolverTest extends TestCase {
  public function testIsSet(): void {
    $resolver = new ExampleResolver();

    $array = [
      'type' => 0,
      'emptyArray' => [],
      'notEmptyArray' => [ 'key' => 'value' ],
      'whatever' => 'string',
    ];

    $this->assertTrue($resolver->publicIsSet($array, 'type'));
    $this->assertFalse($resolver->publicIsSet($array, 'emptyArray'));
    $this->assertTrue($resolver->publicIsSet($array, 'notEmptyArray'));
    $this->assertTrue($resolver->publicIsSet($array, 'whatever'));
    $this->assertFalse($resolver->publicIsSet($array, 'nope'));
  }

  public function testGetValue(): void {
    $resolver = new ExampleResolver();

    $array = [
      'type' => 0,
      'emptyArray' => [],
      'notEmptyArray' => [ 'key' => 'value' ],
      'whatever' => 'string',
    ];

    $this->assertEquals(
      0,
      $resolver->publicGetValue($array, 'type')
    );

    $this->assertEquals(
      null,
      $resolver->publicGetValue($array, 'emptyArray')
    );

    $this->assertEquals(
      'value',
      $resolver->publicGetValue($array, 'notThere', 'value')
    );
  }

  public function testNodesToEdges(): void {
    $resolver = new ExampleResolver();

    $author1 = new Author([ 'id' => 1, 'firstName' => 'Linus', 'lastName' => 'Torvalds' ]);
    $author2 = new Author([ 'id' => 2, 'firstName' => 'Robert', 'lastName' => 'Martin' ]);
    $author3 = new Author([ 'id' => 3, 'firstName' => 'Bill', 'lastName' => 'Gates' ]);

    $array = [$author1, $author2, $author3];

    $this->assertEquals(
      [
        [ 'node' => $author1, 'cursor' => base64_encode('cursor1')],
        [ 'node' => $author2, 'cursor' => base64_encode('cursor2')],
        [ 'node' => $author3, 'cursor' => base64_encode('cursor3')],
      ],
      $resolver->publicNodesToEdges($array, 0)
    );
  }

  public function testGetCursor(): void {
    $resolver = new ExampleResolver();

    $this->assertEquals(
      1,
      $resolver->publicGetCursor(['cursor' => 1], 'cursor')
    );

    $this->assertEquals(
      2,
      $resolver->publicGetCursor(['cursor' => base64_encode('cursor2')], 'cursor')
    );

    $this->assertEquals(
      null,
      $resolver->publicGetCursor(['cursor' => 3], 'notThere')
    );
  }
}

