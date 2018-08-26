<?php

namespace queries;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Author As AuthorType;

use models\Author As AuthorModel;

class Author {
  public static function get() {
    return [
      'type' => AuthorType::get(),
      'args' => [
        'id' => Type::nonNull(Type::id()),
      ],
      'resolve' => function ($root, $args) {
        return AuthorModel::where('id',  $args['id'])->with('quotes')->first();
      }
    ];
  }
}
