<?php

use PHPUnit\Framework\TestCase;
use models\Author;

final class AuthorTest extends TestCase {
  public function testConstructor(): void {
    $author = new Author([
      'id' => 1,
      'firstName' => 'Matej',
      'lastName' => 'Jellus'
    ]);

    $this->assertEquals(
      1,
      $author->getId()
    );

    $this->assertEquals(
      'Matej',
      $author->getFirstName()
    );

    $this->assertEquals(
      'Jellus',
      $author->getLastName()
    );
  }
}

