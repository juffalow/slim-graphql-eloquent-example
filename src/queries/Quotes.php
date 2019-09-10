<?php

namespace queries;

use GraphQL\Type\Definition\Type;
use types\connections\QuoteConnection As QuoteConnectionType;

class Quotes {
  public static function get() {
    return [
      'type' => QuoteConnectionType::get(),
      'args' => [
        'first' => [
          'type' => Type::int(),
          'description' => 'Limits the number of results returned in the page. Defaults to 10.'
        ],
        'after' => [
          'type' => Type::id(),
          'description' => 'The cursor value of an item returned in previous page. An alternative to in integer offset.'
        ],
        'quote' => Type::string(),
      ],
      'resolve' => function ($root, array $args, $context) {
        return $context->resolver->quotes->resolve($args);
      }
    ];
  }
}
