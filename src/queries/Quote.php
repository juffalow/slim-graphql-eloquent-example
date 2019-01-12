<?php

namespace queries;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Quote As QuoteType;

class Quote {
  public static function get() {
    return [
      'type' => QuoteType::get(),
      'args' => [
        'id' => Type::nonNull(Type::id()),
      ],
      'resolve' => function ($root, $args, $context) {
        $id = $args['id'];
        if (!is_numeric($args['id'])) {
          $id = intval(substr(base64_decode($args['id']), strlen('quote')));
        }
    
        return $context->repository->quote->get($id);
      }
    ];
  }
}
