<?php

namespace queries;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Quote As QuoteType;

use models\Quote As QuoteModel;

class Quote {
  public static function get() {
    return [
      'type' => QuoteType::get(),
      'args' => [
        'id' => Type::nonNull(Type::id()),
      ],
      'resolve' => function ($root, $args) {
        return QuoteModel::find($args['id']);
      }
    ];
  }
}
