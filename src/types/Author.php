<?php

namespace types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use types\Node as NodeType;
use types\Quote as QuoteType;
use models\AuthorModelInterface;

class Author extends ObjectType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new ObjectType([
      'name' => 'Author',
      'interfaces' => [
        NodeType::get()
      ],
      'fields' => function() {
        return [
          'id' => [
            'type' => Type::nonNull(Type::id()),
            'description' => 'Globally unique ID of the author',
            'resolve' => function (AuthorModelInterface $author) {
              return base64_encode("author{$author->getId()}");
            }
          ],
          '_id' => [
            'type' => Type::nonNull(Type::id()),
            'description' => 'ID of the author',
            'resolve' => function (AuthorModelInterface $author) {
              return $author->getId();
            }
          ],
          'firstName' => [
            'type' => Type::nonNull(Type::string()),
            'description' => 'Name of the author',
            'resolve' => function (AuthorModelInterface $author) {
              return $author->getFirstName();
            }
          ],
          'lastName' => [
            'type' => Type::nonNull(Type::string()),
            'description' => 'Last name of the author',
            'resolve' => function (AuthorModelInterface $author) {
              return $author->getLastName();
            }
          ],
          'quotes' => [
            'type' => Type::listOf(QuoteType::get()),
            'description' => 'Quotes of the author',
            'resolve' => function (AuthorModelInterface $author) {
              return $author->quotes;
            }
          ]
        ];
      }
    ]);
  }
}
