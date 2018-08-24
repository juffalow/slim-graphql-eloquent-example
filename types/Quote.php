<?php

namespace types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class Quote extends ObjectType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new ObjectType([
      'name' => 'Quote',
      'fields' => [
        'id' => [
          'type' => Type::id(),
          'description' => 'ID of the quote',
          'resolve' => function ($quote) {
            return $quote->id;
          }
        ],
        'quote' => [
          'type' => Type::string(),
          'description' => 'Text of the quote',
          'resolve' => function ($quote) {
            return $quote->quote;
          }
        ],
      ]
    ]);
  }
}
