<?php

namespace di;

class AppFactory {

  static $container;

  public static function setContainer($container) {
    self::$container = $container;
  }

  public static function getDatabase() {
    return self::$container['db'];
  }
}