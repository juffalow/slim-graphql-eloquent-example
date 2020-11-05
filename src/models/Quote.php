<?php

namespace models;

use models\QuoteModelInterface;

class Quote implements QuoteModelInterface {
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

  public function getAuthorId(): int {
    return $this->authorId;
  }
}
