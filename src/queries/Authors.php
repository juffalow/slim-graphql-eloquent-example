<?php

namespace queries;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\connections\AuthorConnection As AuthorConnectionType;
// use types\inputs\orders\AuthorOrder as AuthorOrderType;

use resolvers\AuthorsResolver;

class Authors {
  public static function get() {
    return [
      'type' => AuthorConnectionType::get(),
      'args' => [
        'first' => [
          'type' => Type::int(),
          'description' => 'Limits the number of results returned in the page. Defaults to 10.'
        ],
        'after' => [
          'type' => Type::id(),
          'description' => 'The cursor value of an item returned in previous page. An alternative to in integer offset.'
        ],
        'firstName' => Type::string(),
        'lastName' => Type::string(),
      ],
      'resolve' => function ($root, $args, $context, $resolveInfo) {
        return (new AuthorsResolver($context, $resolveInfo))->resolve($args);
      }
    ];
  }
}