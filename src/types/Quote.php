<?php

namespace types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\Node as NodeType;
use types\Author as AuthorType;

class Quote extends ObjectType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new ObjectType([
      'name' => 'Quote',
      'interfaces' => [
        NodeType::get()
      ],
      'fields' => function() {
        return [
          'id' => [
            'type' => Type::nonNull(Type::id()),
            'description' => 'Globally unique ID of the quote',
            'resolve' => function ($quote) {
              return base64_encode("quote{$quote->getId()}");
            }
          ],
          '_id' => [
            'type' => Type::nonNull(Type::id()),
            'description' => 'ID of the quote',
            'resolve' => function ($quote) {
              return $quote->getId();
            }
          ],
          'quote' => [
            'type' => Type::nonNull(Type::string()),
            'description' => 'Text of the quote',
            'resolve' => function ($quote) {
              return $quote->getQuote();
            }
          ],
          'author' => [
            'type' => AuthorType::get(),
            'description' => 'Author of the quote',
            'resolve' => function ($quote, $args, $context) {
              return $context->repository->author->get($quote->getAuthorId());
            }
          ]
        ];
      }
    ]);
  }
}
