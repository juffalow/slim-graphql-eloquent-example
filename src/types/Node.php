<?php

namespace types;

use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\Type;

class Node extends InterfaceType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new InterfaceType([
      'name' => 'Node',
      'description' => '',
      'fields' => [
        'id' => [
          'type' => Type::nonNull(Type::id()),
          'description' => 'ID',
        ],
      ]
    ]);
  }
}
