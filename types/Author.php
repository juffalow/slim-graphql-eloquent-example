<?php

namespace types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

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
      'fields' => [
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
      ]
    ]);
  }
}
