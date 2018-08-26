<?php

namespace types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Quote as QuoteType;

class Author extends ObjectType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new ObjectType([
      'name' => 'Author',
      'fields' => function() {
        return [
          'id' => [
            'type' => Type::id(),
            'description' => 'ID of the author',
            'resolve' => function ($author) {
              return $author->id;
            }
          ],
          'name' => [
            'type' => Type::string(),
            'description' => 'Name of the author',
            'resolve' => function ($author) {
              return $author->name;
            }
          ],
          'last_name' => [
            'type' => Type::string(),
            'description' => 'Last name of the author',
            'resolve' => function ($author) {
              return $author->last_name;
            }
          ],
          'quotes' => [
            'type' => Type::listOf(QuoteType::get()),
            'description' => 'Quotes of the author',
            'resolve' => function ($author) {
              return $author->quotes;
            }
          ]
        ];
      }
    ]);
  }
}
