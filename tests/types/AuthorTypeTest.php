<?php

use PHPUnit\Framework\TestCase;
use types\Author as AuthorType;
use models\Author;

final class AuthorTypeTest extends TestCase {
  public function testFieldResolveFunctions(): void {
    $authorType = AuthorType::get();
    $authorModel = new Author(['id' => 1, 'firstName' => 'Linus', 'lastName' => 'Torvalds']);

    $resolveIdFn = $authorType->getField('_id')->resolveFn;
    $resolveFirstNameFn = $authorType->getField('firstName')->resolveFn;
    $resolveLastNameFn = $authorType->getField('lastName')->resolveFn;
    
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
}

