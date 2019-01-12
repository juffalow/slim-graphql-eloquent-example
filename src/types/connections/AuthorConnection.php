<?php

namespace types\connections;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\edges\AuthorEdge As AuthorEdgeType;
use types\PageInfo As PageInfoType;

class AuthorConnection extends ObjectType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new ObjectType([
      'name' => 'AuthorConnection',
      'description' => 'The connection type for Author.',
      'fields' => function() { 
        return [
          'totalCount' => [
            'type' => Type::int(),
            'description' => 'Identifies the total count of items in the connection.',
          ],
          'edges' => [
            'type' => Type::listOf(AuthorEdgeType::get()),
            'description' => 'A list of edges.',
          ],
          'pageInfo' => [
            'type' => PageInfoType::get(),
            'description' => 'A list of edges.',
          ]
        ];
      }
    ]);
  }
}
