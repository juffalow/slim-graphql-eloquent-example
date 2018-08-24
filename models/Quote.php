<?php

namespace models;

class Quote extends \models\Model {

  public static function getById($id) {
    return self::getDatabase()->getConnection()->table('quote')->where('id', $id)->first();
  }

  public static function get($page, $limit) {
    return self::getDatabase()
    ->getConnection()
    ->table('quote')
    ->offset(($page - 1) * $limit)
    ->limit($limit)
    ->get();
  }
}
