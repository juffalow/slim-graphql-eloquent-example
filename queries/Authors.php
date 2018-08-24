<?php

namespace queries;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Author As AuthorType;

use models\Author As AuthorModel;

class Authors {
  public static function get() {
    return [
      'type' => Type::listOf(AuthorType::get()),
      'args' => [
        'page' => Type::int(),
        'limit' => Type::int(),
        'q' => Type::string(),
      ],
      'resolve' => function ($root, $args) {
        $page = isset($args['page']) ? $args['page'] : 1;
        $limit = isset($args['limit']) ? $args['limit'] : 10;
        $query = isset($args['q']) ? $args['q'] : null;
        return AuthorModel::get($query, $page, $limit);
      }
    ];
  }
}
