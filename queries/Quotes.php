<?php

namespace queries;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Quote As QuoteType;

use models\Quote As QuoteModel;

class Quotes {
  public static function get() {
    return [
      'type' => Type::listOf(QuoteType::get()),
      'args' => [
        'page' => Type::int(),
        'limit' => Type::int(),
      ],
      'resolve' => function ($root, $args) {
        $page = isset($args['page']) ? $args['page'] : 1;
        $limit = isset($args['limit']) ? $args['limit'] : 10;
        return QuoteModel::get($page, $limit);
      }
    ];
  }
}
