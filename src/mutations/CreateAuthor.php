<?php

namespace mutations;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Author As AuthorType;
use types\inputs\Author As AuthorInputType;

class CreateAuthor {
  public static function get() {
    return [
      'type' => AuthorType::get(),
      'args' => [
        'input' => AuthorInputType::get(),
      ],
      'resolve' => function ($root, $args, $context) {
        $context->service->logger->debug('CreateAuthorMutation', $args);

        $input = $args['input'];

        $firstName = isset($input['firstName']) && !empty($input['firstName']) ? $input['firstName'] : null;
        $lastName = isset($input['lastName']) && !empty($input['lastName']) ? $input['lastName'] : null;

        return $context->repository->author->create($firstName, $lastName);
      }
    ];
  }
}
