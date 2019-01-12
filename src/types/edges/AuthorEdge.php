<?php

namespace types\edges;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Author As AuthorType;

class AuthorEdge extends ObjectType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new ObjectType([
      'name' => 'AuthorEdge',
      'description' => 'List of edges.',
      'fields' => function() {
        return [
          'node' => [
            'type' => AuthorType::get(),
            'description' => 'The item at the end of the edge.',
          ],
          'cursor' => [
            'type' => Type::string(),
            'description' => 'A cursor for pagination.',
          ],
        ];
      }
    ]);
  }
}
