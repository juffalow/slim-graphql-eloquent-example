<?php

namespace resolvers;

/**
 * 
 * @author Matej "juffalow" Jellus <juffalow@juffalow.com>
 */
abstract class Resolver {

  protected $context;

  protected $resolveInfo;

  public function __construct(object $context, object $resolveInfo) {
    $this->context = $context;
    $this->resolveInfo = $resolveInfo;
  }

  public abstract function resolve(array $args);

  /**
   * 
   * @param array $array
   * @param string $key
   * @param ? $default
   */
  protected function getValue(array $array, string $key, $default = null) {
    return $this->isSet($array, $key) ? $array[$key] : $default;
  }

  protected function isSet(array $array, string $key): bool {
    if (!isset($array[$key])) {
      return false;
    }

    if (is_array($array[$key]) && count($array[$key]) > 0) {
      return true;
    }

    if (!is_array($array[$key]) && strlen($array[$key]) > 0) {
      return true;
    }

    return false;
  }

  /**
   * 
   * @param array $args
   * @param string $key
   * @return cursor - ID
   */
  protected function getCursor(array $args, string $key): ?int {
    if (isset($args[$key])) {
      if (is_numeric($args[$key])) {
        return $args[$key];
      }
      return base64_decode($args[$key]);
    }
    return null;
  }

  /**
   * 
   * @param array $nodes
   */
  protected function nodesToEdges($nodes) {
    $edges = [];

    foreach ($nodes AS $node) {
      $edges[] = [
        'node' => $node,
        'cursor' => base64_encode($node->getId())
      ];
    }

    return $edges;
  }
}