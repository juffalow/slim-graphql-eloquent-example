<?php

use PHPUnit\Framework\TestCase;
use resolvers\Resolver;

class ExampleResolver extends Resolver {
  public function __construct() {
    parent::__construct((object)[], (object)[]);
  }

  public function resolve(array $args) {

  }

  public function publicIsSet($array, $key) {
    return $this->isSet($array, $key);
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
}

