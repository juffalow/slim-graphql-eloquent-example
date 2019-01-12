<?php

namespace types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class PageInfo extends ObjectType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new ObjectType([
      'name' => 'PageInfo',
      'description' => 'Information about pagination in a connection.',
      'fields' => function() {
        return [
          'endCursor' => [
            'type' => Type::string(),
            'description' => 'The item at the end of the edge.',
          ],
          'hasNextPage' => [
            'type' => Type::nonNull(Type::boolean()),
            'description' => 'When paginating forwards, are there more items?',
          ],
          'hasPreviousPage' => [
            'type' => Type::nonNull(Type::boolean()),
            'description' => 'When paginating backwards, are there more items?',
          ],
          'startCursor' => [
            'type' => Type::string(),
            'description' => 'When paginating backwards, the cursor to continue.',
          ],
        ];
      }
    ]);
  }
}
