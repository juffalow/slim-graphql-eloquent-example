<?php

namespace mutations;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Author as AuthorType;
use inputTypes\Author as AuthorInputType;
use models\Author As AuthorModel;

class CreateAuthor {
  public static function get() {
    return [
      'type' => AuthorType::get(),
      'args' => [
        'input' => AuthorInputType::get(),
      ],
      'resolve' => function ($root, $args, $context) {
        $input = $args['input'];

        $author = new AuthorModel();
        $author->name = $input['name'];
        $author->last_name = $input['last_name'];

        $author->save();

        return $author;
      }
    ];
  }
}
