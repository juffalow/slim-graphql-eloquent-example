<?php

namespace types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Author as AuthorType;

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
      'fields' => function() {
        return [
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
          'author' => [
            'type' => AuthorType::get(),
            'description' => 'Author of the quote',
            'resolve' => function ($quote) {
              return $quote->author;
            }
          ]
        ];
      }
    ]);
  }
}
