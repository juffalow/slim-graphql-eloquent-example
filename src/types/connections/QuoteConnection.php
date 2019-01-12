<?php

namespace types\connections;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use types\edges\QuoteEdge As QuoteEdgeType;
use types\PageInfo As PageInfoType;

class QuoteConnection extends ObjectType {
  static $type = null;

  public static function get() {
    if (self::$type === null) {
      self::$type = self::create();
    }
    return self::$type;
  }

  private static function create() {
    return new ObjectType([
      'name' => 'QuoteConnection',
      'description' => 'The connection type for Quote.',
      'fields' => function() { 
        return [
          'totalCount' => [
            'type' => Type::int(),
            'description' => 'Identifies the total count of items in the connection.',
          ],
          'edges' => [
            'type' => Type::listOf(QuoteEdgeType::get()),
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
