<?php

namespace types\edges;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Quote As QuoteType;

class QuoteEdge extends ObjectType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new ObjectType([
      'name' => 'QuoteEdge',
      'description' => 'List of edges.',
      'fields' => function() {
        return [
          'node' => [
            'type' => QuoteType::get(),
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
