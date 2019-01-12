<?php

namespace models;

class Quote {
  /**
   * @var int
   */
  protected $id;

  /**
   * @var string
   */
  protected $quote;
  
  /**
   * @var int
   */
  protected $authorId;

  public function __construct(array $values) {
    foreach ($values as $key => $value) {
      $this->$key = $value;
    }
  }

  public function getId(): int {
    return $this->id;
  }

  public function getQuote(): string {
    return $this->quote;
  }

  public function getAuthorId(): string {
    return $this->authorId;
  }
}
