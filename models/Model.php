<?php

namespace models;

use di\AppFactory;

abstract class Model {
  protected static function getDatabase() {
    return AppFactory::getDatabase();
  }
}