<?php

namespace types\inputs;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

class Author extends InputObjectType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
        self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new InputObjectType([
      'name' => 'AuthorInput',
      'fields' => [
        'firstName' => [
          'type' => Type::nonNull(Type::string()),
          'description' => 'First name of the author',
        ],
        'lastName' => [
          'type' => Type::nonNull(Type::string()),
          'description' => 'Last name of the author',
        ]
      ]
    ]);
  }
}
