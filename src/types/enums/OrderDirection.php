<?php

namespace types\enums;

use GraphQL\Type\Definition\EnumType;

class OrderDirection extends EnumType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new EnumType([
      'name' => 'OrderDirection',
      'description' => 'The ordering direction.',
      'values' => [
        'ASC' => [
          'value' => 'asc',
          'description' => 'Specifies an ascending order for a given orderBy argument.'
        ],
        'DESC' => [
          'value' => 'desc',
          'description' => 'Specifies a descending order for a given orderBy argument.'
        ],
      ]
    ]);
  }
}
