<?php

namespace mutations;

use types\Author As AuthorType;
use types\inputs\Author As AuthorInputType;

class CreateAuthor {
  public static function get() {
    return [
      'type' => AuthorType::get(),
      'args' => [
        'input' => AuthorInputType::get(),
      ],
      'resolve' => function ($root, array $args, $context) {
        $context->service->logger->debug('CreateAuthorMutation', $args);

        $input = $args['input'];

        $firstName = $input['firstName'];
        $lastName = $input['lastName'];

        return $context->repository->author->create($firstName, $lastName);
      }
    ];
  }
}
