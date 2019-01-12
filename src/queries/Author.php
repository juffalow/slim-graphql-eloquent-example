<?php

namespace queries;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Author As AuthorType;

class Author {
  public static function get() {
    return [
      'type' => AuthorType::get(),
      'args' => [
        'id' => Type::nonNull(Type::id()),
      ],
      'resolve' => function ($root, $args, $context) {
        $id = $args['id'];
        if (!is_numeric($args['id'])) {
          $id = intval(substr(base64_decode($args['id']), strlen('author')));
        }
    
        return $context->repository->author->get($id);
      }
    ];
  }
}
