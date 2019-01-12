<?php

namespace types\inputs\orders;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;
use types\enums\AuthorOrderField as AuthorOrderFieldType;
use types\enums\OrderDirection as OrderDirectionType;

class AuthorOrder extends InputObjectType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new InputObjectType([
      'name' => 'AuthorOrder',
      'fields' => function() {
        return [
          'field' => [
            'type' => Type::nonNull(AuthorOrderFieldType::get()),
            'description' => '',
          ],
          'direction' => [
            'type' => Type::nonNull(OrderDirectionType::get()),
            'description' => '',
          ],
        ];
      }
    ]);
  }
}
