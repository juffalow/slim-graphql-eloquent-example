<?php

namespace types\enums;

use GraphQL\Type\Definition\EnumType;

class AuthorOrderField extends EnumType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new EnumType([
      'name' => 'AuthorOrderField',
      'description' => 'The ordering direction.',
      'values' => [
        'ID' => [
          'value' => 'id',
          'description' => 'Order authors by ID.',
        ],
        'FIRST_NAME' => [
          'value' => 'name',
          'description' => 'Order authors by first name.'
        ],
        'LAST_NAME' => [
          'value' => 'last_name',
          'description' => 'Order authors by last name.'
        ],
      ]
    ]);
  }
}
