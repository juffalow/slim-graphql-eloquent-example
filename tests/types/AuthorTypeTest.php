<?php

use PHPUnit\Framework\TestCase;
use types\Author as AuthorType;
use models\Author;

final class AuthorTypeTest extends TestCase {
  public function testFieldResolveFunctions(): void {
    $authorType = AuthorType::get();
    $authorModel = new Author(['id' => 1, 'firstName' => 'Linus', 'lastName' => 'Torvalds']);

    $resolveUniqueIdFn = $authorType->getField('id')->resolveFn;
    $resolveIdFn = $authorType->getField('_id')->resolveFn;
    $resolveFirstNameFn = $authorType->getField('firstName')->resolveFn;
    $resolveLastNameFn = $authorType->getField('lastName')->resolveFn;

    $this->assertEquals(
      base64_encode('author1'),
      $resolveUniqueIdFn($authorModel)
    );
    
    $this->assertEquals(
      1,
      $resolveIdFn($authorModel)
    );

    $this->assertEquals(
      'Linus',
      $resolveFirstNameFn($authorModel)
    );

    $this->assertEquals(
      'Torvalds',
      $resolveLastNameFn($authorModel)
    );
  }

  public function testFieldNames(): void {
    $authorType = AuthorType::get();

    $this->assertEquals(
      'id',
      $authorType->getField('id')->name
    );

    $this->assertEquals(
      '_id',
      $authorType->getField('_id')->name
    );


    $this->assertEquals(
      'firstName',
      $authorType->getField('firstName')->name
    );

    $this->assertEquals(
      'lastName',
      $authorType->getField('lastName')->name
    );
  }

  public function testFieldDescriptions(): void {
    $authorType = AuthorType::get();

    $this->assertGreaterThan(
      0,
      strlen($authorType->getField('id')->description)
    );

    $this->assertGreaterThan(
      0,
      strlen($authorType->getField('_id')->description)
    );


    $this->assertGreaterThan(
      0,
      strlen($authorType->getField('firstName')->description)
    );

    $this->assertGreaterThan(
      0,
      strlen($authorType->getField('lastName')->description)
    );
  }
}

