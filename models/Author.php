<?php

namespace models;

class Author extends \models\Model {

  public static function getById($id) {
    return self::getDatabase()->getConnection()->table('author')->where('id', $id)->first();
  }

  public static function get($query, $page, $limit) {
    return self::getDatabase()
    ->getConnection()
    ->table('author')
    ->offset(($page - 1) * $limit)
    ->limit($limit)
    ->get();
  }
}
